
<div class="container-fluid">

	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Details User</h4> </div>
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<?php echo breadcrumb($this->uri->segment_array()); ?>
				</ol>
			</div>
				<!-- /.col-lg-12 -->
			</div>

      <div class="row">
					<div class="col-md-3">
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
					<div class="col-lg-12 col-sm-12 col-xs-12">
            <div class="white-box">
                <div class="panel panel-inverse">
									<div class="panel-heading text-center">
										Menu Kepegawaian
									</div>
                </div>
                <!-- <p class="text-muted m-b-30">Use default tab with class <code>customtab</code></p> -->
                <!-- Nav tabs -->
                <ul class="nav customtab nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#biodata1" aria-controls="biodata" role="tab" data-toggle="tab" aria-expanded="true"><span class="visible-xs"><i class="ti-user"></i></span><span class="hidden-xs">Biodata</span></a></li>
                    <li role="presentation" class=""><a href="#pangkat1" aria-controls="pangkat" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-star"></i></span> <span class="hidden-xs">Pangkat</span></a></li>
                    <li role="presentation" class=""><a href="#jabatan1" aria-controls="jabatan" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-id-badge"></i></span> <span class="hidden-xs">Jabatan</span></a></li>
                    <li role="presentation" class=""><a href="#pendidikan1" aria-controls="pendidikan" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-briefcase"></i></span> <span class="hidden-xs">Pendidikan</span></a></li>
                    <li role="presentation" class=""><a href="#latihan1" aria-controls="latihan" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-flag-alt"></i></span> <span class="hidden-xs">Latihan</span></a></li>
                    <li role="presentation" class=""><a href="#unit_kerja1" aria-controls="unit_kerja" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-bookmark"></i></span> <span class="hidden-xs">Unit Kerja</span></a></li>
                    <li role="presentation" class=""><a href="#penghargaan1" aria-controls="penghargaan" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-medall"></i></span> <span class="hidden-xs">Penghargaan</span></a></li>
                    <li role="presentation" class=""><a href="#absen1" aria-controls="absen" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-check-box"></i></span> <span class="hidden-xs">Absen</span></a></li>
                    <li role="presentation" class=""><a href="#bahasa1" aria-controls="bahasa" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-themify-favicon"></i></span> <span class="hidden-xs">Bahasa</span></a></li>
                    <li role="presentation" class=""><a href="#keluarga1" aria-controls="keluarga" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-heart"></i></span> <span class="hidden-xs">Keluarga</span></a></li>
                    <!-- <li role="presentation" class=""><a href="#berkas1" aria-controls="berkas" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-package"></i></span> <span class="hidden-xs">Berkas</span></a></li> -->
                </ul>
                <!-- Tab panes -->
								<div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade active in" id="biodata1">
											<div id="list_biodata">
												<button type="button" class="btn btn-primary" id="edit_biodata" name="button">Edit Biodata</button>
												<hr>
												<div class="row">
			                    <div class="col-md-12">
			                        <div class="panel panel-info">
			                            <div class="panel-wrapper collapse in" aria-expanded="true">
			                                <div class="panel-body">
			                                    <form class="form-horizontal" role="form">
			                                        <div class="form-body">
			                                            <h3 class="box-title">Nama Lengkap & Gelar</h3>
			                                            <hr class="m-t-0 m-b-40">
			                                            <div class="row">
			                                                <div class="col-md-4">
			                                                    <div class="form-group">
			                                                        <label class="control-label col-md-6">Gelar di depan nama :</label>
			                                                        <div class="col-md-6">
			                                                            <p class="form-control-static"><?=isset($data_pegawai->nama_gelardepan) ? $data_pegawai->nama_gelardepan : "-" ?> </p>
			                                                        </div>
			                                                    </div>
			                                                </div>
			                                                <!--/span-->
			                                                <div class="col-md-4">
			                                                    <div class="form-group">
			                                                        <label class="control-label col-md-6">Nama Lengkap :</label>
			                                                        <div class="col-md-6">
			                                                            <p class="form-control-static"> <?=isset($data_pegawai->nama_lengkap) ? $data_pegawai->nama_lengkap : "-" ?> </p>
			                                                        </div>
			                                                    </div>
			                                                </div>
			                                                <!--/span-->
			                                                <div class="col-md-4">
			                                                    <div class="form-group">
			                                                        <label class="control-label col-md-6">Gelar di belakang nama :</label>
			                                                        <div class="col-md-6">
			                                                            <p class="form-control-static"> <?=isset($data_pegawai->nama_gelarbelakang) ? $data_pegawai->nama_gelarbelakang : "-" ?> </p>
			                                                        </div>
			                                                    </div>
			                                                </div>
			                                                <!--/span-->
			                                            </div>
			                                            <!--/row-->
			                                            <hr class="m-t-0 m-b-40">
			                                            <div class="row">
			                                                <div class="col-md-6">
			                                                    <div class="form-group">
			                                                        <label class="control-label col-md-6">Tempat Lahir :</label>
			                                                        <div class="col-md-6">
			                                                            <p class="form-control-static"> <?=isset($data_pegawai->tempat_lahir) ? $data_pegawai->tempat_lahir : "-" ?> </p>
			                                                        </div>
			                                                    </div>
			                                                </div>
			                                                <!--/span-->
			                                                <div class="col-md-6">
			                                                    <div class="form-group">
			                                                        <label class="control-label col-md-6">Tanggal Lahir :</label>
			                                                        <div class="col-md-6">
			                                                            <p class="form-control-static"> <?=isset($data_pegawai->tgl_lahir) ? tanggal($data_pegawai->tgl_lahir) : "-" ?> </p>
			                                                        </div>
			                                                    </div>
			                                                </div>
			                                                <!--/span-->
			                                                <div class="col-md-6">
			                                                    <div class="form-group">
			                                                        <label class="control-label col-md-6">Agama :</label>
			                                                        <div class="col-md-6">
			                                                            <p class="form-control-static"><?=isset($data_pegawai->nama_agama) ? $data_pegawai->nama_agama : "-" ?> </p>
			                                                        </div>
			                                                    </div>
			                                                </div>
			                                                <!--/span-->
			                                                <div class="col-md-6">
			                                                    <div class="form-group">
			                                                        <label class="control-label col-md-6">Jenis Kelamin :</label>
			                                                        <div class="col-md-6">
																																<?php
																																if ($data_pegawai->jenis_kelamin == 1) {
																																	$jk = "Laki-laki";
																																}elseif ($data_pegawai->jenis_kelamin == 2){
																																	$jk = "Perempuan";
																																}
																																 ?>
			                                                            <p class="form-control-static"><?=isset($data_pegawai->jenis_kelamin) ? $jk : "-" ?> </p>
			                                                        </div>
			                                                    </div>
			                                                </div>
			                                                <!--/span-->
			                                            </div>
			                                            <!--/row-->
			                                            <h3 class="box-title">Alamat</h3>
			                                            <hr class="m-t-0 m-b-40">
			                                            <div class="row">
			                                                <div class="col-md-12">
			                                                    <div class="form-group">
			                                                        <label class="control-label col-md-3">Alamat:</label>
			                                                        <div class="col-md-9">
			                                                            <p class="form-control-static"><?=isset($data_pegawai->alamat) ? $data_pegawai->alamat : "-" ?> </p>
			                                                        </div>
			                                                    </div>
			                                                </div>
			                                            </div>
			                                            <div class="row">
			                                                <div class="col-md-6">
			                                                    <div class="form-group">
			                                                        <label class="control-label col-md-3">RT:</label>
			                                                        <div class="col-md-9">
			                                                            <p class="form-control-static"><?=isset($data_pegawai->RT) ? $data_pegawai->RT : "-" ?> </p>
			                                                        </div>
			                                                    </div>
			                                                </div>
			                                                <!--/span-->
			                                                <div class="col-md-6">
			                                                    <div class="form-group">
			                                                        <label class="control-label col-md-3">RW:</label>
			                                                        <div class="col-md-9">
			                                                            <p class="form-control-static"><?=isset($data_pegawai->RW) ? $data_pegawai->RW : "-" ?> </p>
			                                                        </div>
			                                                    </div>
			                                                </div>
			                                                <!--/span-->
			                                            </div>
			                                            <!--/row-->
			                                            <div class="row">
			                                                <div class="col-md-6">
			                                                    <div class="form-group">
			                                                        <label class="control-label col-md-3">Kode Pos:</label>
			                                                        <div class="col-md-9">
			                                                            <p class="form-control-static"><?=isset($data_pegawai->kode_pos) ? $data_pegawai->kode_pos : "-" ?> </p>
			                                                        </div>
			                                                    </div>
			                                                </div>
			                                                <!--/span-->
			                                                <div class="col-md-6">
			                                                    <div class="form-group">
			                                                        <label class="control-label col-md-3">Telepon:</label>
			                                                        <div class="col-md-9">
			                                                            <p class="form-control-static"><?=isset($data_pegawai->telepon) ? $data_pegawai->telepon : "-" ?> </p>
			                                                        </div>
			                                                    </div>
			                                                </div>
			                                                <!--/span-->
			                                            </div>
			                                            <div class="row">
			                                                <div class="col-md-6">
			                                                    <div class="form-group">
			                                                        <label class="control-label col-md-3">Provinsi:</label>
			                                                        <div class="col-md-9">
			                                                            <p class="form-control-static"><?=isset($data_pegawai->provinsi) ? $data_pegawai->provinsi : "-" ?> </p>
			                                                        </div>
			                                                    </div>
			                                                </div>
			                                                <!--/span-->
			                                                <div class="col-md-6">
			                                                    <div class="form-group">
			                                                        <label class="control-label col-md-3">Kabupaten/Kota</label>
			                                                        <div class="col-md-9">
			                                                            <p class="form-control-static"><?=isset($data_pegawai->kabupaten) ? $data_pegawai->kabupaten : "-" ?> </p>
			                                                        </div>
			                                                    </div>
			                                                </div>
			                                                <!--/span-->
			                                            </div>
			                                            <div class="row">
			                                                <div class="col-md-6">
			                                                    <div class="form-group">
			                                                        <label class="control-label col-md-3">Kecamatan:</label>
			                                                        <div class="col-md-9">
			                                                            <p class="form-control-static"><?=isset($data_pegawai->kecamatan) ? $data_pegawai->kecamatan : "-" ?> </p>
			                                                        </div>
			                                                    </div>
			                                                </div>
			                                                <!--/span-->
			                                                <div class="col-md-6">
			                                                    <div class="form-group">
			                                                        <label class="control-label col-md-3">Kelurahan/Desa</label>
			                                                        <div class="col-md-9">
			                                                            <p class="form-control-static"><?=isset($data_pegawai->desa) ? $data_pegawai->desa : "-" ?> </p>
			                                                        </div>
			                                                    </div>
			                                                </div>
			                                                <!--/span-->
			                                            </div>
																									<h3 class="box-title">Keluarga</h3>
			                                            <hr class="m-t-0 m-b-40">
			                                            <div class="row">
			                                                <div class="col-md-12">
			                                                    <div class="form-group">
			                                                        <label class="control-label col-md-4">Status Perkawinan:</label>
			                                                        <div class="col-md-8">
			                                                            <p class="form-control-static"><?=isset($data_pegawai->nama_statusmenikah) ? $data_pegawai->nama_statusmenikah : "-" ?> </p>
			                                                        </div>
			                                                    </div>
			                                                </div>
			                                                <!--/span-->
			                                                <div class="col-md-12">
			                                                    <div class="form-group">
			                                                        <label class="control-label col-md-4">Jumlah Tanggungan Anak:</label>
			                                                        <div class="col-md-8">
			                                                            <p class="form-control-static"><?=isset($data_pegawai->jml_tanggungan_anak) ? $data_pegawai->jml_tanggungan_anak : "-" ?> </p>
			                                                        </div>
			                                                    </div>
			                                                </div>
			                                                <!--/span-->
			                                                <div class="col-md-12">
			                                                    <div class="form-group">
			                                                        <label class="control-label col-md-4">Jumlah Seluruh Anak:</label>
			                                                        <div class="col-md-8">
			                                                            <p class="form-control-static"><?=isset($data_pegawai->jml_seluruh_anak) ? $data_pegawai->jml_seluruh_anak : "-" ?> </p>
			                                                        </div>
			                                                    </div>
			                                                </div>
			                                                <!--/span-->
			                                            </div>
			                                            <!--/row-->
																									<h3 class="box-title">Kedudukan Pegawai</h3>
			                                            <hr class="m-t-0 m-b-40">
			                                            <div class="row">
			                                                <div class="col-md-6">
			                                                    <div class="form-group">
			                                                        <label class="control-label col-md-3">Status:</label>
			                                                        <div class="col-md-9">
																																<?php if ($data_pegawai->status_pegawai == "Aktif") {
																																	$stat_peg = "Aktif";
																																}elseif ($data_pegawai->status_pegawai == "Pensiun") {
																																	$stat_peg = "Pensiun";
																																}elseif ($data_pegawai->status_pegawai == "Mutasi") {
																																	$stat_peg = "Mutasi";
																																}elseif ($data_pegawai->status_pegawai == "Hukuman Disiplin") {
																																	$stat_peg = "Hukuman Disiplin";
																																}elseif ($data_pegawai->status_pegawai == "Menunggu Tugas") {
																																	$stat_peg = "Menunggu Tugas";
																																}elseif ($data_pegawai->status_pegawai == "Meninggal Dunia") {
																																	$stat_peg = "Meninggal Dunia";
																																}else{
																																	$stat_peg = "-";
																																}
																																echo "<p class='form-control-static'>".$stat_peg."</p>"
																																?>

			                                                        </div>
			                                                    </div>
			                                                </div>
			                                                <!--/span-->
			                                                <div class="col-md-6">
			                                                    <div class="form-group">
			                                                        <label class="control-label col-md-3">Kategori:</label>
			                                                        <div class="col-md-9">
			                                                            <p class="form-control-static"><?=isset($data_pegawai->kedudukan_pegawai) ? $data_pegawai->kedudukan_pegawai : "-" ?> </p>
			                                                        </div>
			                                                    </div>
			                                                </div>
			                                                <!--/span-->
			                                            </div>
			                                            <!--/row-->
																									<h3 class="box-title">Pengangkatan CPNS</h3>
			                                            <hr class="m-t-0 m-b-40">
			                                            <div class="row">
			                                                <div class="col-md-6">
			                                                    <div class="form-group">
			                                                        <label class="control-label col-md-3">TMT:</label>
			                                                        <div class="col-md-9">
			                                                            <p class="form-control-static"><?=isset($data_pegawai->cpns_tmt) ? tanggal($data_pegawai->cpns_tmt) : "-" ?> </p>
			                                                        </div>
			                                                    </div>
			                                                </div>
			                                                <!--/span-->
			                                                <div class="col-md-6">
			                                                    <div class="form-group">
			                                                        <label class="control-label col-md-3">No. Persetujuan BAKN:</label>
			                                                        <div class="col-md-9">
			                                                            <p class="form-control-static"><?=isset($data_pegawai->cpns_no_bakn) ? $data_pegawai->cpns_no_bakn : "-" ?> </p>
			                                                        </div>
			                                                    </div>
			                                                </div>
			                                                <!--/span-->
			                                                <div class="col-md-6">
			                                                    <div class="form-group">
			                                                        <label class="control-label col-md-3">Gol. Ruang:</label>
			                                                        <div class="col-md-9">
																																<?php
																																foreach ($golongan as $gol_cpns) { ?>
																																	<?php if ($gol_cpns->id_golongan == $data_pegawai->cpns_id_golongan): ?>
																																		<p class="form-control-static"><?=isset($gol_cpns->golongan) ? $gol_cpns->golongan : "-" ?></p>
																																	<?php endif; ?>
																																<?php } ?>
			                                                        </div>
			                                                    </div>
			                                                </div>
			                                                <!--/span-->
			                                                <div class="col-md-6">
			                                                    <div class="form-group">
			                                                        <label class="control-label col-md-3">Pejabat:</label>
			                                                        <div class="col-md-9">
			                                                            <p class="form-control-static"><?=isset($data_pegawai->cpns_pejabat) ? $data_pegawai->cpns_pejabat : "-" ?></p>
			                                                        </div>
			                                                    </div>
			                                                </div>
			                                                <!--/span-->
			                                                <div class="col-md-6">
			                                                    <div class="form-group">
			                                                        <label class="control-label col-md-3">No. SK CPNS:</label>
			                                                        <div class="col-md-9">
			                                                            <p class="form-control-static"><?=isset($data_pegawai->cpns_no_sk) ? $data_pegawai->cpns_no_sk : "-" ?></p>
			                                                        </div>
			                                                    </div>
			                                                </div>
			                                                <!--/span-->
			                                                <div class="col-md-6">
			                                                    <div class="form-group">
			                                                        <label class="control-label col-md-3">Pendidikan Saat CPNS:</label>
			                                                        <div class="col-md-9">
																																<?php
																																foreach ($jenjangpendidikan as $jp_cpns) { ?>
																																	<?php if ($jp_cpns->id_jenjangpendidikan == $data_pegawai->cpns_id_jenjangpendidikan): ?>
																																		<p class="form-control-static"><?=isset($jp_cpns->nama_jenjangpendidikan) ? $jp_cpns->nama_jenjangpendidikan : "-" ?></p>
																																	<?php endif; ?>
																																<?php } ?>
			                                                        </div>
			                                                    </div>
			                                                </div>
			                                                <!--/span-->
			                                                <div class="col-md-6">
			                                                    <div class="form-group">
			                                                        <label class="control-label col-md-3">Masa Kerja (Tahun):</label>
			                                                        <div class="col-md-9">
			                                                            <p class="form-control-static"> - </p>
			                                                        </div>
			                                                    </div>
			                                                </div>
			                                                <!--/span-->
			                                                <div class="col-md-6">
			                                                    <div class="form-group">
			                                                        <label class="control-label col-md-3">Masa Kerja (Bulan):</label>
			                                                        <div class="col-md-9">
			                                                            <p class="form-control-static"> - </p>
			                                                        </div>
			                                                    </div>
			                                                </div>
			                                                <!--/span-->
			                                                <div class="col-md-6">
			                                                    <div class="form-group">
			                                                        <label class="control-label col-md-3">Tahun Lulus Pendidikan:</label>
			                                                        <div class="col-md-9">
			                                                            <p class="form-control-static"><?=isset($data_pegawai->cpns_tahun_pendidikan) ? $data_pegawai->cpns_tahun_pendidikan : "-" ?></p>
			                                                        </div>
			                                                    </div>
			                                                </div>
			                                                <!--/span-->
			                                            </div>
			                                            <!--/row-->
																									<h3 class="box-title">Pengangkatan PNS</h3>
			                                            <hr class="m-t-0 m-b-40">
			                                            <div class="row">
			                                                <div class="col-md-6">
			                                                    <div class="form-group">
			                                                        <label class="control-label col-md-3">TMT:</label>
			                                                        <div class="col-md-9">
			                                                            <p class="form-control-static"><?=isset($data_pegawai->pns_tmt) ? tanggal($data_pegawai->pns_tmt) : "-" ?></p>
			                                                        </div>
			                                                    </div>
			                                                </div>
			                                                <!--/span-->
			                                                <div class="col-md-6">
			                                                    <div class="form-group">
			                                                        <label class="control-label col-md-3">Gol. Ruang:</label>
			                                                        <div class="col-md-9">
																																<?php
																																foreach ($golongan as $gol_pns) { ?>
																																	<?php if ($gol_pns->id_golongan == $data_pegawai->pns_id_golongan): ?>
																																		<p class="form-control-static"><?=isset($gol_pns->golongan) ? $gol_pns->golongan : "-" ?></p>
																																	<?php endif; ?>
																																<?php } ?>
			                                                        </div>
			                                                    </div>
			                                                </div>
			                                                <!--/span-->
			                                                <div class="col-md-6">
			                                                    <div class="form-group">
			                                                        <label class="control-label col-md-3">Pejabat:</label>
			                                                        <div class="col-md-9">
			                                                            <p class="form-control-static"><?=isset($data_pegawai->pns_pejabat) ? $data_pegawai->pns_pejabat : "-" ?></p>
			                                                        </div>
			                                                    </div>
			                                                </div>
			                                                <!--/span-->
			                                                <div class="col-md-6">
			                                                    <div class="form-group">
			                                                        <label class="control-label col-md-3">No. SK:</label>
			                                                        <div class="col-md-9">
			                                                            <p class="form-control-static"><?=isset($data_pegawai->pns_no_sk) ? $data_pegawai->pns_no_sk : "-" ?></p>
			                                                        </div>
			                                                    </div>
			                                                </div>
			                                                <!--/span-->
			                                            </div>
			                                            <!--/row-->
																									<h3 class="box-title">Nomor Induk Pegawai (NIP)</h3>
			                                            <hr class="m-t-0 m-b-40">
			                                            <div class="row">
			                                                <div class="col-md-6">
			                                                    <div class="form-group">
			                                                        <label class="control-label col-md-3">Lama:</label>
			                                                        <div class="col-md-9">
			                                                            <p class="form-control-static"><?=isset($data_pegawai->nip_lama) ? $data_pegawai->nip_lama : "-" ?></p>
			                                                        </div>
			                                                    </div>
			                                                </div>
			                                                <!--/span-->
			                                                <div class="col-md-6">
			                                                    <div class="form-group">
			                                                        <label class="control-label col-md-3">Baru:</label>
			                                                        <div class="col-md-9">
			                                                            <p class="form-control-static"><?=isset($data_pegawai->nip_baru) ? $data_pegawai->nip_baru : "-" ?></p>
			                                                        </div>
			                                                    </div>
			                                                </div>
			                                                <!--/span-->
			                                                <div class="col-md-6">
			                                                    <div class="form-group">
			                                                        <label class="control-label col-md-3">Karpeg:</label>
			                                                        <div class="col-md-9">
			                                                            <p class="form-control-static"><?=isset($data_pegawai->karpeg) ? $data_pegawai->karpeg : "-" ?></p>
			                                                        </div>
			                                                    </div>
			                                                </div>
			                                                <!--/span-->
			                                            </div>
			                                            <!--/row-->
																									<h3 class="box-title">Nomor-nomor Kartu</h3>
			                                            <hr class="m-t-0 m-b-40">
			                                            <div class="row">
			                                                <div class="col-md-6">
			                                                    <div class="form-group">
			                                                        <label class="control-label col-md-3">Kartu ASKES:</label>
			                                                        <div class="col-md-9">
			                                                            <p class="form-control-static"><?=isset($data_pegawai->kartu_askes) ? $data_pegawai->kartu_askes : "-" ?></p>
			                                                        </div>
			                                                    </div>
			                                                </div>
			                                                <!--/span-->
			                                                <div class="col-md-6">
			                                                    <div class="form-group">
			                                                        <label class="control-label col-md-3">Kartu TASPEN:</label>
			                                                        <div class="col-md-9">
			                                                            <p class="form-control-static"><?=isset($data_pegawai->kartu_taspen) ? $data_pegawai->kartu_taspen : "-" ?></p>
			                                                        </div>
			                                                    </div>
			                                                </div>
			                                                <!--/span-->
			                                                <div class="col-md-6">
			                                                    <div class="form-group">
			                                                        <label class="control-label col-md-3">KARIS/KARSU:</label>
			                                                        <div class="col-md-9">
			                                                            <p class="form-control-static"><?=isset($data_pegawai->karis_karsu) ? $data_pegawai->karis_karsu : "-" ?></p>
			                                                        </div>
			                                                    </div>
			                                                </div>
			                                                <!--/span-->
			                                                <div class="col-md-6">
			                                                    <div class="form-group">
			                                                        <label class="control-label col-md-3">NPWP:</label>
			                                                        <div class="col-md-9">
			                                                            <p class="form-control-static"><?=isset($data_pegawai->npwp) ? $data_pegawai->npwp : "-" ?></p>
			                                                        </div>
			                                                    </div>
			                                                </div>
			                                                <!--/span-->
			                                            </div>
			                                            <!--/row-->
																									<h3 class="box-title">Riwayat Pendidikan Terakhir</h3>
			                                            <hr class="m-t-0 m-b-40">
																									<?php
																									$total = count($data_pendidikan);
																									$i = 1;
																									foreach ($data_pendidikan as $datpens): ?>
																										<?php if ($i == $total && $datpens->status == 1): ?>
																											<div class="row">
					                                                <div class="col-md-6">
					                                                    <div class="form-group">
					                                                        <label class="control-label col-md-3">Jenjang Pendidikan:</label>
					                                                        <div class="col-md-9">
					                                                            <p class="form-control-static"><?=isset($datpens->nama_jenjangpendidikan) ? $datpens->nama_jenjangpendidikan : "-" ?></p>
					                                                        </div>
					                                                    </div>
					                                                </div>
					                                                <!--/span-->
					                                                <div class="col-md-6">
					                                                    <div class="form-group">
					                                                        <label class="control-label col-md-3">Nama Sekolah:</label>
					                                                        <div class="col-md-9">
					                                                            <p class="form-control-static"><?=isset($datpens->nama_tempatpendidikan) ? $datpens->nama_tempatpendidikan : "-" ?></p>
					                                                        </div>
					                                                    </div>
					                                                </div>
					                                                <!--/span-->
					                                                <div class="col-md-6">
					                                                    <div class="form-group">
					                                                        <label class="control-label col-md-3">Jurusan:</label>
					                                                        <div class="col-md-9">
					                                                            <p class="form-control-static"><?=isset($datpens->nama_jurusan) ? $datpens->nama_jurusan : "-" ?></p>
					                                                        </div>
					                                                    </div>
					                                                </div>
					                                                <!--/span-->
					                                                <div class="col-md-6">
					                                                    <div class="form-group">
					                                                        <label class="control-label col-md-3">No Ijazah:</label>
					                                                        <div class="col-md-9">
					                                                            <p class="form-control-static"> - </p>
					                                                        </div>
					                                                    </div>
					                                                </div>
					                                                <!--/span-->
					                                                <div class="col-md-6">
					                                                    <div class="form-group">
					                                                        <label class="control-label col-md-3">Tahun Lulus:</label>
					                                                        <div class="col-md-9">
					                                                            <p class="form-control-static"> - </p>
					                                                        </div>
					                                                    </div>
					                                                </div>
					                                                <!--/span-->
					                                                <div class="col-md-6">
					                                                    <div class="form-group">
					                                                        <label class="control-label col-md-3">Pejabat Penetapan:</label>
					                                                        <div class="col-md-9">
					                                                            <p class="form-control-static"><?=isset($datpens->nama_pejabat) ? $datpens->nama_pejabat : "-" ?></p>
					                                                        </div>
					                                                    </div>
					                                                </div>
					                                                <!--/span-->
					                                            </div>
					                                            <!--/row-->
																											<?php endif; ?>
																										<?php
																										$i++;
																									endforeach; ?>

																									<h3 class="box-title">Riwayat Pangkat Terakhir</h3>
			                                            <hr class="m-t-0 m-b-40">
																									<?php
																									$total = count($data_pangkat);
																									$i = 1;
																									foreach ($data_pangkat as $row): ?>
																										<?php if ($i == $total && $row->status == 1): ?>
			                                            <div class="row">
			                                                <div class="col-md-6">
			                                                    <div class="form-group">
			                                                        <label class="control-label col-md-3">Pangkat:</label>
			                                                        <div class="col-md-9">
			                                                            <p class="form-control-static"><?=isset($row->pangkat) ? $row->pangkat : "-" ?></p>
			                                                        </div>
			                                                    </div>
			                                                </div>
			                                                <!--/span-->
			                                                <div class="col-md-6">
			                                                    <div class="form-group">
			                                                        <label class="control-label col-md-3">TMT:</label>
			                                                        <div class="col-md-9">
			                                                            <p class="form-control-static"><?=isset($row->tmt_berlaku) ? tanggal($row->tmt_berlaku) : "-" ?></p>
			                                                        </div>
			                                                    </div>
			                                                </div>
			                                                <!--/span-->
			                                                <div class="col-md-6">
			                                                    <div class="form-group">
			                                                        <label class="control-label col-md-3">Golongan:</label>
			                                                        <div class="col-md-9">
			                                                            <p class="form-control-static"><?=isset($row->golongan) ? $row->golongan : "-" ?></p>
			                                                        </div>
			                                                    </div>
			                                                </div>
			                                                <!--/span-->
			                                                <div class="col-md-6">
			                                                    <div class="form-group">
			                                                        <label class="control-label col-md-3">No. SK:</label>
			                                                        <div class="col-md-9">
			                                                            <p class="form-control-static"><?=isset($row->no_sk) ? $row->no_sk : "-" ?></p>
			                                                        </div>
			                                                    </div>
			                                                </div>
			                                                <!--/span-->
			                                                <div class="col-md-6">
			                                                    <div class="form-group">
			                                                        <label class="control-label col-md-3">Tgl. SK:</label>
			                                                        <div class="col-md-9">
			                                                            <p class="form-control-static"><?=isset($row->tgl_sk) ? tanggal($row->tgl_sk) : "-" ?></p>
			                                                        </div>
			                                                    </div>
			                                                </div>
			                                                <!--/span-->
			                                                <div class="col-md-6">
			                                                    <div class="form-group">
			                                                        <label class="control-label col-md-3">Pejabat Penetap:</label>
			                                                        <div class="col-md-9">
			                                                            <p class="form-control-static"><?=isset($row->nama_pejabat) ? $row->nama_pejabat : "-" ?></p>
			                                                        </div>
			                                                    </div>
			                                                </div>
			                                                <!--/span-->
			                                                <div class="col-md-6">
			                                                    <div class="form-group">
			                                                        <label class="control-label col-md-3">Gaji Pokok:</label>
			                                                        <div class="col-md-9">
			                                                            <p class="form-control-static"><?=isset($row->gaji_pokok) ? $row->gaji_pokok : "-" ?></p>
			                                                        </div>
			                                                    </div>
			                                                </div>
			                                                <!--/span-->
			                                            </div>
			                                            <!--/row-->
																											<?php endif; ?>
																										<?php
																										$i++;
																									endforeach; ?>
																									<h3 class="box-title">Riwayat Jabatan Terakhir</h3>
			                                            <hr class="m-t-0 m-b-40">
																									<?php
																									$total = count($data_jabatan);
																									$i = 1;
																									foreach ($data_jabatan as $row): ?>
																										<?php if ($i == $total && $row->status == 1): ?>
			                                            <div class="row">
			                                                <div class="col-md-6">
			                                                    <div class="form-group">
			                                                        <label class="control-label col-md-3">Jabatan:</label>
			                                                        <div class="col-md-9">
			                                                            <p class="form-control-static"><?=isset($row->nama_jabatan_sementara) ? $row->nama_jabatan_sementara : "-" ?></p>
			                                                        </div>
			                                                    </div>
			                                                </div>
			                                                <!--/span-->
			                                                <div class="col-md-6">
			                                                    <div class="form-group">
			                                                        <label class="control-label col-md-3">TMT:</label>
			                                                        <div class="col-md-9">
			                                                            <p class="form-control-static"> - </p>
			                                                        </div>
			                                                    </div>
			                                                </div>
			                                                <!--/span-->
			                                                <div class="col-md-6">
			                                                    <div class="form-group">
			                                                        <label class="control-label col-md-3">No. SK:</label>
			                                                        <div class="col-md-9">
			                                                            <p class="form-control-static"><?=isset($row->no_sk) ? $row->no_sk : "-" ?></p>
			                                                        </div>
			                                                    </div>
			                                                </div>
			                                                <!--/span-->
			                                                <div class="col-md-6">
			                                                    <div class="form-group">
			                                                        <label class="control-label col-md-3">Tgl. SK:</label>
			                                                        <div class="col-md-9">
			                                                            <p class="form-control-static"><?=isset($row->tgl_sk) ? tanggal($row->tgl_sk) : "-" ?></p>
			                                                        </div>
			                                                    </div>
			                                                </div>
			                                                <!--/span-->
			                                                <div class="col-md-6">
			                                                    <div class="form-group">
			                                                        <label class="control-label col-md-3">Pejabat Penetap:</label>
			                                                        <div class="col-md-9">
			                                                            <p class="form-control-static"><?=isset($row->nama_pejabat) ? $row->nama_pejabat : "-" ?></p>
			                                                        </div>
			                                                    </div>
			                                                </div>
			                                                <!--/span-->
			                                                <div class="col-md-6">
			                                                    <div class="form-group">
			                                                        <label class="control-label col-md-3">Uraian Jabatan:</label>
			                                                        <div class="col-md-9">
			                                                            <p class="form-control-static"> - </p>
			                                                        </div>
			                                                    </div>
			                                                </div>
			                                                <!--/span-->
			                                            </div>
			                                            <!--/row-->
																											<?php endif; ?>
																										<?php
																										$i++;
																									endforeach; ?>
																									<h3 class="box-title">Riwayat Unit Kerja Terakhir</h3>
			                                            <hr class="m-t-0 m-b-40">
																									<?php
																									$total = count($data_unit_kerja);
																									$i = 1;
																									foreach ($data_unit_kerja as $row): ?>
																										<?php if ($i == $total && $row->status == 1): ?>
			                                            <div class="row">
			                                                <div class="col-md-6">
			                                                    <div class="form-group">
			                                                        <label class="control-label col-md-3">Nama Unit Kerja:</label>
			                                                        <div class="col-md-9">
			                                                            <p class="form-control-static"> - </p>
			                                                        </div>
			                                                    </div>
			                                                </div>
			                                                <!--/span-->
			                                                <div class="col-md-6">
			                                                    <div class="form-group">
			                                                        <label class="control-label col-md-3">Alamat:</label>
			                                                        <div class="col-md-9">
			                                                            <p class="form-control-static"> - </p>
			                                                        </div>
			                                                    </div>
			                                                </div>
			                                                <!--/span-->
			                                                <div class="col-md-6">
			                                                    <div class="form-group">
			                                                        <label class="control-label col-md-3">Telepon:</label>
			                                                        <div class="col-md-9">
			                                                            <p class="form-control-static"> - </p>
			                                                        </div>
			                                                    </div>
			                                                </div>
			                                                <!--/span-->
			                                                <div class="col-md-6">
			                                                    <div class="form-group">
			                                                        <label class="control-label col-md-3">Email:</label>
			                                                        <div class="col-md-9">
			                                                            <p class="form-control-static"> - </p>
			                                                        </div>
			                                                    </div>
			                                                </div>
			                                                <!--/span-->
			                                            </div>
			                                            <!--/row-->
																										<?php endif; ?>
																									<?php
																									$i++;
																								endforeach; ?>
			                                        </div>
			                                    </form>
			                                </div>
			                            </div>
			                        </div>
			                    </div>
			                </div>
											</div>
											<div id="form_biodata">
												<button type="button" class="btn btn-primary" id="lihat_biodata" name="button">Lihat Biodata</button>
												<hr>
												<form method="post">
													<input type="hidden" name="nip" value="<?=$data_by_bkd->nip?>">
	                              <div class="form-body">
	                                  <h4 class="box-title">Nama Lengkap dan Gelar</h4>
	                                  <hr>
	                                  <div class="row">
	                                      <div class="col-md-4">
	                                          <div class="form-group">
	                                              <label class="control-label">Gelar didepan nama</label>
	                                              <select class="form-control" name="id_gelardepan">
																									<option value="">-</option>
																									<?php foreach ($gelardepan as $row): ?>
																										<?php
																										$selected = "";
																										if ($row->id_gelardepan == $data_pegawai->id_gelardepan) {
																											$selected = "selected";
																										} ?>
																										<option value="<?=$row->id_gelardepan;?>" <?=$selected?>><?=$row->nama_gelardepan?></option>
																									<?php endforeach; ?>
	                                              </select>
	 																					</div>
	                                      </div>

	                                      <div class="col-md-4">
	                                          <div class="form-group">
	                                              <label class="control-label">Nama Lengkap</label>
																								<input type="text" class="form-control" name="nama_lengkap" value="<?=isset($data_pegawai->nama_lengkap) ? $data_pegawai->nama_lengkap : "-" ?>">
	 																					</div>
	                                      </div>

	                                      <div class="col-md-4">
	                                          <div class="form-group">
	                                              <label class="control-label">Gelar dibelakang nama</label>
																								<select class="form-control" name="id_gelarbelakang">
																									<option value="">-</option>
																									<?php foreach ($gelarbelakang as $row): ?>
																										<?php
																										$selected = "";
																										if ($row->id_gelarbelakang == $data_pegawai->id_gelarbelakang) {
																											$selected = "selected";
																										} ?>
																										<option value="<?=$row->id_gelarbelakang;?>" <?=$selected?>><?=$row->nama_gelarbelakang?></option>
																									<?php endforeach; ?>
																								</select>
	 																					</div>
	                                      </div>

	                                  </div>
	                                  <div class="row">
	                                      <div class="col-md-4">
	                                          <div class="form-group">
	                                              <label class="control-label">Tempat Lahir*</label>
	                                              <input type="text" class="form-control" name="tempat_lahir" value="<?=isset($data_pegawai->tempat_lahir) ? $data_pegawai->tempat_lahir : "-" ?>">
	 																					</div>
	                                      </div>

	                                      <div class="col-md-4">
	                                          <div class="form-group">
	                                              <label class="control-label">Tanggal Lahir*</label>
																								<input type="date" class="form-control" name="tgl_lahir" value="<?=isset($data_pegawai->tgl_lahir) ? $data_pegawai->tgl_lahir : "-" ?>">
	 																					</div>
	                                      </div>

	                                      <div class="col-md-4">
	                                          <div class="form-group">
	                                              <label class="control-label">Agama*</label>
																								<select class="form-control" name="id_agama">
																									<option value="">-</option>
																									<?php foreach ($agama as $row): ?>
																										<?php
																										$selected = "";
																										if ($row->id_agama == $data_pegawai->id_agama) {
																											$selected = "selected";
																										} ?>
																										<option value="<?=$row->id_agama;?>" <?=$selected?>><?=$row->nama_agama?></option>
																									<?php endforeach; ?>
																								</select>
	 																					</div>
	                                      </div>

	                                      <div class="col-md-4">
																					<div class="form-group">
																						<label class="control-label">Jenis Kelamin*</label>
																						<div class="radio-list">
																								<label class="radio-inline p-0">
																										<div class="radio radio-info">
																											<?php
																												$man = "";
																											if ($data_pegawai->jenis_kelamin == 1){
																												$man = "checked";
																											}?>
																												<input type="radio" name="jenis_kelamin" id="radio1" value="1" <?=$man?>>
																												<label for="radio1" >Laki - laki</label>
																										</div>
																								</label>
																								<label class="radio-inline">
																										<div class="radio radio-info">
																											<?php
																												$woman = "";
																											if ($data_pegawai->jenis_kelamin == 2){
																												$woman = "checked";
																											}?>
																												<input type="radio" name="jenis_kelamin" id="radio2" value="2" <?=$woman?>>
																												<label for="radio2">Perempuan</label>
																										</div>
																								</label>
																						</div>
																				</div>
	                                      </div>

	                                  </div>
																		<h4 class="box-title">Alamat</h4>
																		<hr>
																		<div class="row">
																				<div class="col-md-4">
																						<div class="form-group">
																								<label class="control-label">Alamat*</label>
																								<textarea name="alamat" class="form-control" rows="15" cols="80"><?=isset($data_pegawai->alamat) ? $data_pegawai->alamat : "-" ?></textarea>
																						</div>
																				</div>

																				<div class="col-md-4">
																						<div class="form-group">
																								<label class="control-label">RT*</label>
																								<input type="text" class="form-control" name="RT" value="<?=isset($data_pegawai->RT) ? $data_pegawai->RT : "-" ?>">
																						</div>
																				</div>

																				<div class="col-md-4">
																						<div class="form-group">
																								<label class="control-label">Provinsi</label>
																								<select class="form-control" name="id_provinsi" id='id_provinsi' onchange='getKabupaten()'>
																									<option value="">Pilih</option>
																									<?php foreach ($provinsi as $row): ?>
																										<?php
																										$selected = "";
																										if ($row->id_provinsi == $data_pegawai->id_provinsi) {
																											$selected = "selected";
																										} ?>
																										<option value="<?=$row->id_provinsi;?>" <?=$selected?>><?=$row->provinsi?></option>
																									<?php endforeach; ?>
																								</select>
																						</div>
																				</div>

																				<div class="col-md-4">
																						<div class="form-group">
																								<label class="control-label">RW*</label>
																								<input type="text" class="form-control" name="RW" value="<?=isset($data_pegawai->RW) ? $data_pegawai->RW : "-" ?>">
																						</div>
																				</div>

																				<div class="col-md-4">
																						<div class="form-group">
																								<label class="control-label">Kabupaten/Kota*</label>
																								<select class="form-control" name="id_kabupaten" id='id_kabupaten' onchange='getKecamatan()'>
																									<?php if ($data_pegawai->id_kabupaten): ?>
																										<?php foreach ($kabupaten as $row): ?>
																											<?php
																											$selected = "";
																											if ($row->id_kabupaten == $data_pegawai->id_kabupaten) {
																												$selected = "selected";
																												echo '<option value="'.$row->id_kabupaten.'"'.$selected.'">'.$row->kabupaten.'</option>';
																											} ?>
																										<?php endforeach; ?>
																									<?php endif; ?>
																								</select>
																						</div>
																				</div>

																				<div class="col-md-4">
																						<div class="form-group">
																								<label class="control-label">Kode POS</label>
																								<input type="text" class="form-control" name="kode_pos" value="<?=isset($data_pegawai->kode_pos) ? $data_pegawai->kode_pos : "-" ?>">
																						</div>
																				</div>

																				<div class="col-md-4">
																						<div class="form-group">
																								<label class="control-label">Kecamatan*</label>
																								<select class="form-control" name="id_kecamatan" id='id_kecamatan' onchange='getDesa()'>
																									<?php if ($data_pegawai->id_kecamatan): ?>
																										<?php foreach ($kecamatan as $row): ?>
																											<?php
																											$selected = "";
																											if ($row->id_kecamatan == $data_pegawai->id_kecamatan) {
																												$selected = "selected";
																												echo '<option value="'.$row->id_kecamatan.'"'.$selected.'">'.$row->kecamatan.'</option>';
																											} ?>
																										<?php endforeach; ?>
																									<?php endif; ?>
																								</select>
																						</div>
																				</div>

																				<div class="col-md-4">
																						<div class="form-group">
																								<label class="control-label">Telepon</label>
																								<input type="text" class="form-control" name="telepon" value="<?=isset($data_pegawai->telepon) ? $data_pegawai->telepon : "-" ?>">
																						</div>
																				</div>

																				<div class="col-md-4">
																						<div class="form-group">
																								<label class="control-label">Kelurahan/Desa*</label>
																								<select class="form-control" name="id_desa" id='id_desa'>
																									<?php if ($data_pegawai->id_desa): ?>
																										<?php foreach ($desa as $row): ?>
																											<?php
																											$selected = "";
																											if ($row->id_desa == $data_pegawai->id_desa) {
																												$selected = "selected";
																											} ?>
																											<option value="<?=$row->id_desa;?>" <?=$selected?>><?=$row->desa?></option>
																										<?php endforeach; ?>
																									<?php endif; ?>
																								</select>
																						</div>
																				</div>

																		</div>
																		<h4 class="box-title">Keluarga*</h4>
																		<hr>
																		<div class="row">
																				<div class="col-md-4">
																						<div class="form-group">
																								<label class="control-label">Status Perkawinan*</label>
																								<select class="form-control" name="id_statusmenikah">
																									<option value="">Pilih</option>
																									<?php foreach ($statusmenikah as $row): ?>
																										<?php
																										$selected = "";
																										if ($row->id_statusmenikah == $data_pegawai->id_statusmenikah) {
																											$selected = "selected";
																										} ?>
																										<option value="<?=$row->id_statusmenikah;?>" <?=$selected?>><?=$row->nama_statusmenikah?></option>
																									<?php endforeach; ?>
																								</select>
																						</div>
																				</div>

																				<div class="col-md-4">
																						<div class="form-group">
																								<label class="control-label">Jumlah Tanggung Anak</label>
																								<input type="number" class="form-control" name="jml_tanggungan_anak" value="<?=isset($data_pegawai->jml_tanggungan_anak) ? $data_pegawai->jml_tanggungan_anak : "-" ?>">
																						</div>
																				</div>

																				<div class="col-md-4">
																						<div class="form-group">
																							<label class="control-label">Jumlah Seluruh Anak</label>
																							<input type="number" class="form-control" name="jml_seluruh_anak" value="<?=isset($data_pegawai->jml_seluruh_anak) ? $data_pegawai->jml_seluruh_anak : "-" ?>">
																						</div>
																				</div>

																		</div>
																		<h4 class="box-title">Kedudukan Pegawai*</h4>
																		<hr>
																		<div class="row">
																			<div class="col-md-6">
																				<div class="form-group">
																					<select class='form-control' name='kedudukan_pegawai' id='kedudukan_pegawai'>
																						<option value="">Pilih</option>
																						<?php
																							$selected1 = $data_pegawai->kedudukan_pegawai=="Aktif" ? "selected" : "";
																							$selected2 = $data_pegawai->kedudukan_pegawai=="Pensiun" ? "selected" : "";
																							$selected3 = $data_pegawai->kedudukan_pegawai=="Mutasi" ? "selected" : "";
																							$selected4 = $data_pegawai->kedudukan_pegawai=="Hukuman Disiplin" ? "selected" : "";
																							$selected5 = $data_pegawai->kedudukan_pegawai=="Menunggu Tugas" ? "selected" : "";
																							$selected6 = $data_pegawai->kedudukan_pegawai=="Meninggal Dunia" ? "selected" : "";
																						?>
																						<option value='Aktif' <?= $selected1;?>>Aktif</option>
																						<option value='Pensiun' <?= $selected2;?>>Pensiun</option>
																					  <option value='Mutasi' <?= $selected3;?>>Mutasi</option>
																						<option value='Hukuman Disiplin' <?= $selected4;?>>Hukuman Disiplin</option>
																						<option value='Menunggu Tugas' <?= $selected5;?>>Menunggu Tugas</option>
																						<option value='Meninggal Dunia' <?= $selected6;?>>Meninggal Dunia</option>
																					</select>
																				</div>
																				<div class="form-group">
																					<?php
																						$checked1 = $data_pegawai->status_pegawai==1 ? "checked" : "";
																						$checked2 = $data_pegawai->status_pegawai==2 ? "checked" : "";
																					?>

																					<label class="radio-inline">
																						<input type="radio" name="status_pegawai" id="status_pegawai" value="1" <?= $checked1;?> />PNS
																					</label>
																					<label class="radio-inline">
																						<input type="radio" name="status_pegawai" id="status_pegawai" value="2" <?= $checked2;?> />NON PNS
																					</label>
																				</div>
																			</div>
																		</div>
																		<h4 class="box-title">Pembayaran gaji Pegawai*</h4>
																		<hr>
																		<div class="row">
																			<div class="col-md-12">
																				<div class="form-group">
																					<label>Bayar Gaji Dari : </label>
																					<?php
																						$bayar_gaji1 = $data_pegawai->bayar_gaji=="Kas Daerah Sumedang" ? "checked" : "";
																						$bayar_gaji2 = $data_pegawai->bayar_gaji=="Luar Kas Daerah Sumedang" ? "checked" : "";
																					?>
																					<label class="radio-inline">
																						<input <?= $bayar_gaji1;?> type="radio" name="bayar_gaji" id="bayar_gaji1" value="Kas Daerah Sumedang" >Kas Daerah Sumedang
																					</label>
																					<label class="radio-inline">
																						<input <?= $bayar_gaji2;?> type="radio" name="bayar_gaji" id="bayar_gaji2" value="Luar Kas Daerah Sumedang" />Luar Kas Daerah Sumedang
																					</label>
																				</div>
																			</div>
																		</div>
																		<h4 class="box-title">Pengangkatan CPNS</h4>
																		<hr>
																		<div class="row">
																			<div class="col-md-4">
																					<div class="form-group">
																							<label class="control-label">TMT</label>
																							<input type="date" class="form-control" name="cpns_tmt" value="<?=isset($data_pegawai->cpns_tmt) ? $data_pegawai->cpns_tmt : "-" ?>">
																					</div>
																					<div class="form-group">
																							<label class="control-label">Gol. Ruang</label>
																							<select class="form-control" name="cpns_id_golongan">
																								<option value="">Pilih</option>
																								<?php foreach ($golongan as $row): ?>
																									<?php
																									$selected = "";
																									if ($row->id_golongan == $data_pegawai->cpns_id_golongan) {
																										$selected = "selected";
																									} ?>
																									<option value="<?=$row->id_golongan;?>" <?=$selected?>><?=$row->golongan?></option>
																								<?php endforeach; ?>
																							</select>
																					</div>
																					<div class="form-group">
																							<label class="control-label">No. SK CPNS</label>
																							<input type="number" class="form-control" name="cpns_no_sk" value="<?=isset($data_pegawai->cpns_no_sk) ? $data_pegawai->cpns_no_sk : "-" ?>">
																					</div>
																					<!-- <div class="form-group">
																							<label class="control-label">Masa Kerja (tahun)</label>
																							<input type="number" class="form-control" name="massa_tahun" value="">
																					</div>
																					<div class="form-group">
																							<label class="control-label">Masa Kerja (bulan)</label>
																							<input type="number" class="form-control" name="massa_bulan" value="">
																					</div> -->
																			</div>

																			<div class="col-md-4">
																					<div class="form-group">
																							<label class="control-label">No. Persetujuan BAKN</label>
																							<input type="number" class="form-control" name="cpns_no_bakn" value="<?=isset($data_pegawai->cpns_no_bakn) ? $data_pegawai->cpns_no_bakn : "-" ?>">
																					</div>
																					<div class="form-group">
																							<label class="control-label">Pejabat</label>
																							<input type="text" class="form-control" name="cpns_pejabat" value="<?=isset($data_pegawai->nama_pejabat) ? $data_pegawai->nama_pejabat : "-" ?>">
																					</div>
																			</div>

																			<div class="col-md-4">
																					<div class="form-group">
																						<label class="control-label">Pendidikan Saat CPNS</label>
																						<select class="form-control" name="cpns_id_jenjangpendidikan">
																							<option value="">Pilih</option>
																							<?php foreach ($jenjangpendidikan as $row): ?>
																								<?php
																								$selected = "";
																								if ($row->id_jenjangpendidikan == $data_pegawai->id_jenjangpendidikan) {
																									$selected = "selected";
																								} ?>
																								<option value="<?=$row->id_jenjangpendidikan;?>" <?=$selected?>><?=$row->nama_jenjangpendidikan?></option>
																							<?php endforeach; ?>
																						</select>
																					</div>
																					<div class="form-group">
																						<label class="control-label">Tahun Lulus Pendidikan</label>
																						<input type="date" class="form-control" name="cpns_tahun_pendidikan" value="<?=isset($data_pegawai->cpns_tahun_pendidikan) ? $data_pegawai->cpns_tahun_pendidikan : "-" ?>">
																					</div>
																			</div>

																		</div>
																		<h4 class="box-title">Pengangkatan PNS</h4>
																		<hr>
																		<div class="row">
																				<div class="col-md-3">
																						<div class="form-group">
																								<label class="control-label">TMT</label>
																								<input type="date" class="form-control" name="pns_tmt" value="<?=isset($data_pegawai->pns_tmt) ? $data_pegawai->pns_tmt : "-" ?>">
																						</div>
																				</div>

																				<div class="col-md-3">
																						<div class="form-group">
																								<label class="control-label">Gol. Ruang</label>
																								<select class="form-control" name="pns_id_golongan">
																									<option value="">Pilih</option>
																									<?php foreach ($golongan as $row): ?>
																										<?php
																										$selected = "";
																										if ($row->id_golongan == $data_pegawai->pns_id_golongan) {
																											$selected = "selected";
																										} ?>
																										<option value="<?=$row->id_golongan;?>" <?=$selected?>><?=$row->golongan?></option>
																									<?php endforeach; ?>
																								</select>
																						</div>
																				</div>

																				<div class="col-md-3">
																						<div class="form-group">
																							<label class="control-label">Pejabat</label>
																							<input type="text" class="form-control" name="pns_pejabat" value="<?=isset($data_pegawai->pns_pejabat) ? $data_pegawai->pns_pejabat : "-" ?>">
																						</div>
																				</div>

																				<div class="col-md-3">
																						<div class="form-group">
																							<label class="control-label">No. SK</label>
																							<input type="number" class="form-control" name="pns_no_sk" value="<?=isset($data_pegawai->pns_no_sk) ? $data_pegawai->pns_no_sk : "-" ?>">
																						</div>
																				</div>

																		</div>
																		<h4 class="box-title">Nomor Induk Pegawai (NIP)</h4>
																		<hr>
																		<div class="row">
																				<div class="col-md-4">
																						<div class="form-group">
																								<label class="control-label">Lama</label>
																								<input type="number" class="form-control" name="nip_lama" value="<?=isset($data_pegawai->nip_lama) ? $data_pegawai->nip_lama : "-" ?>">
																						</div>
																				</div>

																				<div class="col-md-4">
																						<div class="form-group">
																								<label class="control-label">Baru*</label>
																								<input type="number" class="form-control" name="nip_baru" value="<?=isset($data_pegawai->nip_baru) ? $data_pegawai->nip_baru : "-" ?>">
																						</div>
																				</div>

																				<div class="col-md-4">
																						<div class="form-group">
																								<label class="control-label">Karpeg</label>
																								<input type="text" class="form-control" name="karpeg" value="<?=isset($data_pegawai->karpeg) ? $data_pegawai->karpeg : "-" ?>">
																						</div>
																				</div>

																		</div>
																		<h4 class="box-title">Nomor-nomor Kartu</h4>
																		<hr>
																		<div class="row">
																				<div class="col-md-3">
																						<div class="form-group">
																								<label class="control-label">Kartu ASKES</label>
																								<input type="number" class="form-control" name="kartu_askes" value="<?=isset($data_pegawai->kartu_askes) ? $data_pegawai->kartu_askes : "-" ?>">
																						</div>
																				</div>

																				<div class="col-md-3">
																						<div class="form-group">
																								<label class="control-label">Kartu TASPEN</label>
																								<input type="number" class="form-control" name="kartu_taspen" value="<?=isset($data_pegawai->kartu_taspen) ? $data_pegawai->kartu_taspen : "-" ?>">
																						</div>
																				</div>

																				<div class="col-md-3">
																						<div class="form-group">
																								<label class="control-label">KARIS/KARSU</label>
																								<input type="number" class="form-control" name="karis_karsu" value="<?=isset($data_pegawai->karis_karsu) ? $data_pegawai->karis_karsu : "-" ?>">
																						</div>
																				</div>

																				<div class="col-md-3">
																						<div class="form-group">
																								<label class="control-label">NPWP</label>
																								<input type="number" class="form-control" name="npwp" value="<?=isset($data_pegawai->npwp) ? $data_pegawai->npwp : "-" ?>">
																						</div>
																				</div>

																		</div>
																		<!-- <h4 class="box-title">Riwayat Pendidikan Terakhir</h4>
																		<hr>
																		<div class="row">
																				<div class="col-md-3">
																						<div class="form-group">
																								<label class="control-label">Jenjang Pendidikan</label>
																								<input type="text" class="form-control" name="jenjang_pendidikan" value="">
																						</div>
																				</div>

																				<div class="col-md-3">
																						<div class="form-group">
																								<label class="control-label">Nama Sekolah</label>
																								<input type="text" class="form-control" name="nama_sekolah" value="">
																						</div>
																				</div>

																				<div class="col-md-3">
																						<div class="form-group">
																								<label class="control-label">Jurusan</label>
																								<input type="text" class="form-control" name="jurusan" value="">
																						</div>
																				</div>

																				<div class="col-md-3">
																						<div class="form-group">
																								<label class="control-label">No. Ijazah</label>
																								<input type="number" class="form-control" name="no_ijazah" value="">
																						</div>
																						<div class="form-group">
																								<label class="control-label">Tahun Lulus</label>
																								<input type="number" class="form-control" name="tahun_lulus" value="">
																						</div>
																						<div class="form-group">
																								<label class="control-label">Pejabat Penetapan</label>
																								<input type="text" class="form-control" name="pejabat_penetapan" value="">
																						</div>
																				</div>

																		</div> -->
																		<!-- <h4 class="box-title">Riwayat Pangkat Terakhir</h4>
																		<hr>
																		<div class="row">
																				<div class="col-md-3">
																						<div class="form-group">
																								<label class="control-label">Pangkat</label>
																								<input type="text" class="form-control" name="pangkat" value="">
																						</div>
																						<div class="form-group">
																								<label class="control-label">Golongan</label>
																								<input type="text" class="form-control" name="golongan_pangkat" value="">
																						</div>
																				</div>

																				<div class="col-md-3">
																						<div class="form-group">
																								<label class="control-label">TMT</label>
																								<input type="date" class="form-control" name="tmtpangkat" value="">
																						</div>
																				</div>

																				<div class="col-md-3">
																						<div class="form-group">
																								<label class="control-label">No. SK</label>
																								<input type="text" class="form-control" name="no_sk_pangkat" value="">
																						</div>
																						<div class="form-group">
																								<label class="control-label">Tgl. SK</label>
																								<input type="text" class="form-control" name="tgl_sk_pangkat" value="">
																						</div>
																						<div class="form-group">
																								<label class="control-label">Pejabat Penetap</label>
																								<input type="text" class="form-control" name="pejabat_penetap_pangkat" value="">
																						</div>
																				</div>

																				<div class="col-md-3">
																						<div class="form-group">
																								<label class="control-label">Gaji Pokok</label>
																								<input type="number" class="form-control" name="gaji_pokok" value="">
																						</div>
																				</div>

																		</div> -->
																		<!-- <h4 class="box-title">Riwayat Jabatan Terakhir</h4>
																		<hr>
																		<div class="row">
																				<div class="col-md-4">
																						<div class="form-group">
																								<label class="control-label">Jabatan</label>
																								<input type="text" class="form-control" name="jabatan" value="">
																						</div>
																				</div>

																				<div class="col-md-4">
																					<div class="form-group">
																							<label class="control-label">TMT</label>
																							<input type="date" class="form-control" name="tmt_jabatan" value="">
																					</div>
																						<div class="form-group">
																								<label class="control-label">No. SK</label>
																								<input type="text" class="form-control" name="no_sk_jabatan" value="">
																						</div>
																						<div class="form-group">
																								<label class="control-label">Tgl. SK</label>
																								<input type="text" class="form-control" name="tgl_sk_jabatan" value="">
																						</div>
																				</div>

																				<div class="col-md-4">
																						<div class="form-group">
																								<label class="control-label">Uraian Jabatan</label>
																								<input type="text" class="form-control" name="uraian_jabatan" value="">
																						</div>
																				</div>

																		</div> -->
																		<!-- <h4 class="box-title">Unit Kerja Terakhir</h4>
																		<hr>
																		<div class="row">
																				<div class="col-md-3">
																						<div class="form-group">
																								<label class="control-label">Nama Unit Kerja</label>
																								<input type="text" class="form-control" name="unit_kerja" value="">
																						</div>
																				</div>

																				<div class="col-md-3">
																					<div class="form-group">
																							<label class="control-label">Alamat</label>
																							<textarea name="alamat" class="form-control" rows="3" cols="80"></textarea>
																					</div>
																				</div>

																				<div class="col-md-3">
																						<div class="form-group">
																								<label class="control-label">Telepon</label>
																								<input type="date" class="form-control" name="telp_unit_kerja" value="">
																						</div>
																				</div>


																				<div class="col-md-3">
																						<div class="form-group">
																								<label class="control-label">Email</label>
																								<input type="email" class="form-control" name="email_unit_kerja" value="">
																						</div>
																				</div>

																		</div> -->
	                              </div>
	                              <div class="form-actions">
	                                  <button type="submit" name="update_master_pegawai" class="btn btn-success"> <i class="fa fa-check"></i>Save</button>
	                                  <button type="button" class="btn btn-default">Cancel</button>
	                              </div>
	                          </form>
	                        <div class="clearfix"></div>
											</div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="pangkat1">
											<div id="table_riwayat_pangkat">
												<button type="button" name="tambah_riwayat_pangkat" id="tambah_riwayat_pangkat" class="btn btn-primary">Tambah Riwayat Pangkat</button>
												<hr>
												<div class="table-responsive">
																<table class="table color-table primary-table">
																		<thead>
																				<tr>
																						<th>#</th>
																						<th>Golongan Ruang</th>
																						<th>Pangkat</th>
																						<th>Berlaku TMT</th>
																						<th>Gaji Pokok</th>
																						<th>Nama Pejabat</th>
																						<th>No. SK</th>
																						<th>Tgl. SK</th>
																						<th>Status</th>
																						<th>Aksi</th>
																				</tr>
																		</thead>
																		<tbody>
																			<?php foreach ($data_pangkat as $pangkat): ?>
																				<tr>
																						<td><?=isset($pangkat) ? $pangkat->id : "" ?></td>
																						<td><?=isset($pangkat) ? $pangkat->golongan : "" ?></td>
																						<td><?=isset($pangkat) ? $pangkat->pangkat : "" ?></td>
																						<td><?=isset($pangkat) ? tanggal($pangkat->tgl_sk) : "" ?></td>
																						<td><?=isset($pangkat) ? $pangkat->gaji_pokok : "" ?></td>
																						<td><?=isset($pangkat) ? $pangkat->nama_pejabat : "" ?></td>
																						<td><?=isset($pangkat) ? $pangkat->no_sk : "" ?></td>
																						<td><?=isset($pangkat) ? tanggal($pangkat->tgl_sk) : "" ?></td>
																						<td>
																							<?php if ($pangkat->verifikasi_pegawai == "true" && $pangkat->verifikasi_bkd == "true"): ?>
																								<span class="label label-success">Sudah Diverifikasi</span>
																								<?php else: ?>
																								<span class="label label-danger">Belum Diverifikasi oleh Pegawai / BKD</span>
																							<?php endif; ?>
																						</td>
																						<td>
																							<?php if ($pangkat->verifikasi_bkd == false): ?>
																							<button type="submit" class="btn btn-info btn-sm btn-rounded" data-toggle="modal" data-target="#verif_pangkat<?=$pangkat->id?>"> <i class="ti-check"></i> </button>
																							<button type="submit" class="btn btn-warning btn-sm btn-rounded" data-toggle="modal" data-target="#catat_pangkat<?=$pangkat->id?>"> <i class="ti-pencil"></i> </button>
																							<?php endif; ?>
																							<button type="submit" class="btn btn-danger btn-sm btn-rounded" data-toggle="modal" data-target="#delete_pangkat<?=$pangkat->id?>"><i class="ti-trash"></i></button>
																						</td>
																				</tr>
																				<!-- verif row -->
						                            <div class="modal fade bs-example-modal-sm" id="verif_pangkat<?=$pangkat->id?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
						                                <div class="modal-dialog modal-sm">
						                                    <div class="modal-content">
						                                        <div class="modal-header" style="background-color:#008efa">
						                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						                                            <h4 class="modal-title" id="myLargeModalLabel" style="color:white">Alert !</h4>
						                                        </div>
						                                        <div class="modal-body">
																											Apakah anda yakin akan memverifikasi data ini ?
						                                        </div>
						                                        <div class="modal-footer">
																											<form method="post">
																												<input type="hidden" name="id_pangkat" value="<?=$pangkat->id?>">
																												<button type="submit" class="btn btn-danger waves-effect text-left" name="verif_pangkat" >Verifikasi</button>
																											</form>
						                                            <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Batal</button>
						                                        </div>
						                                    </div>
						                                    <!-- /.modal-content -->
						                                </div>
						                                <!-- /.modal-dialog -->
						                            </div>
																				<!-- catat row -->
						                            <div class="modal fade bs-example-modal-md" id="catat_pangkat<?=$pangkat->id?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
						                                <div class="modal-dialog modal-md">
						                                    <div class="modal-content">
						                                        <div class="modal-header" style="background-color:#f0ad4e">
						                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						                                            <h4 class="modal-title" id="myLargeModalLabel" style="color:white">Alert !</h4>
						                                        </div>
																										<form method="post">
																											<input type="hidden" name="id_pangkat" value="<?=$pangkat->id?>">
						                                        <div class="modal-body">
																											Catatan :
																											<textarea name="catatan_verifikasi" class="form-control" rows="8" cols="80"></textarea>
						                                        </div>
						                                        <div class="modal-footer">
																												<button type="submit" class="btn btn-danger waves-effect text-left" name="catat_pangkat" >Verifikasi</button>
						                                            <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Batal</button>
						                                        </div>
																										</form>
						                                    </div>
						                                    <!-- /.modal-content -->
						                                </div>
						                                <!-- /.modal-dialog -->
						                            </div>
																				<!-- delete row -->
						                            <div class="modal fade bs-example-modal-sm" id="delete_pangkat<?=$pangkat->id?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
						                                <div class="modal-dialog modal-sm">
						                                    <div class="modal-content">
						                                        <div class="modal-header" style="background-color:#f75b36">
						                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						                                            <h4 class="modal-title" id="myLargeModalLabel" style="color:white">Alert !</h4>
						                                        </div>
						                                        <div class="modal-body">
																											Apakah anda yakin akan menghapus data ini ?
						                                        </div>
						                                        <div class="modal-footer">
																											<form method="post">
																												<input type="hidden" name="id_pangkat" value="<?=$pangkat->id?>">
																												<button type="submit" class="btn btn-danger waves-effect text-left" name="delete_pangkat" >Hapus</button>
																											</form>
						                                            <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Batal</button>
						                                        </div>
						                                    </div>
						                                    <!-- /.modal-content -->
						                                </div>
						                                <!-- /.modal-dialog -->
						                            </div>

																			<?php endforeach; ?>
																		</tbody>
																</table>
														</div>
											</div>
											<div id="form_riwayat_pangkat">
												<button type="button" name="lihat_riwayat_pangkat" id="lihat_riwayat_pangkat" class="btn btn-primary">Lihat Riwayat Pangkat</button>
												<hr>
												<form method="post">
													<input type="hidden" name="nip" value="<?=$data_by_bkd->nip?>">
													<div class="form-group">
														<label for="">Golongan</label>
														<select class="form-control" id='id_golongan' onchange='setGol()' name="id_golongan">
															<option value="">Pilih</option>
															<?php
															foreach ($golongan as $row ){
																echo "<option value='$row->id_golongan'>$row->pangkat</option>";
															}
															?>
														</select>
													</div>
													<div class="form-group">
														<label for="">Pangkat</label>
														<input type="text" class="form-control" id='txt_golongan' name="pangkat" value="" readonly>
													</div>
													<div class="form-group">
														<label for="">Berlaku TMT</label>
														<input type="date" class="form-control" name="tmt_berlaku" value="">
													</div>
													<div class="form-group">
														<label for="">Gaji Pokok</label>
														<input type="number" class="form-control" name="gaji_pokok" value="">
													</div>
													<div class="form-group">
														<label for="">Nama Pejabat</label>
														<input type="text" class="form-control" name="nama_pejabat" value="">
													</div>
													<div class="form-group">
														<label for="">Nomor SK</label>
														<input type="number" class="form-control" name="no_sk" value="">
													</div>
													<div class="form-group">
														<label for="">Tanggal SK</label>
														<input type="date" class="form-control" name="tgl_sk" value="">
													</div>
													<hr>
													<button type="submit" class="btn btn-primary" name="submit_pangkat">Simpan</button>
												</form>
											</div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="jabatan1">
											<div id="table_riwayat_jabatan">
												<button type="button" id="tambah_riwayat_jabatan" class="btn btn-primary">Tambah Riwayat Jabatan</button>
												<hr>
												<div class="table-responsive">
																<table class="table color-table primary-table">
																		<thead>
																				<tr>
																						<th>#</th>
																						<th>Tanggal Mulai</th>
																						<th>Tanggal Akhir</th>
																						<th>Gol. Ruang</th>
																						<th>Gaji Pokok</th>
																						<th>Nama Pejabat</th>
																						<th>No. SK</th>
																						<th>Tgl. SK</th>
																						<th>Status</th>
																						<th>Aksi</th>
																				</tr>
																		</thead>
																		<tbody>
																			<?php foreach ($data_jabatan as $jabatan): ?>
																				<tr>
																						<td>1</td>
																						<td><?=isset($jabatan) ? tanggal($jabatan->tgl_mulai) : "" ?></td>
																						<td><?=isset($jabatan->tgl_akhir) ? tanggal($jabatan->tgl_akhir) : "Sampai Sekarang" ?></td>
																						<td><?=isset($jabatan) ? $jabatan->pangkat : "" ?></td>
																						<td><?=isset($jabatan) ? $jabatan->gaji_pokok : "" ?></td>
																						<td><?=isset($jabatan) ? $jabatan->nama_pejabat : "" ?></td>
																						<td><?=isset($jabatan) ? $jabatan->no_sk : "" ?></td>
																						<td><?=isset($jabatan) ? tanggal($jabatan->tgl_sk) : "" ?></td>
																						<td>
																							<?php if ($jabatan->verifikasi_pegawai == "true" && $jabatan->verifikasi_bkd == "true"): ?>
																								<span class="label label-success">Sudah Diverifikasi</span>
																								<?php else: ?>
																								<span class="label label-danger">Belum Diverifikasi oleh Pegawai / BKD</span>
																							<?php endif; ?>
																						</td>
																						<td>
																							<?php if ($jabatan->verifikasi_bkd == false): ?>
																							<button type="submit" class="btn btn-info btn-sm btn-rounded" data-toggle="modal" data-target="#verif_jabatan<?=$jabatan->id?>"> <i class="ti-check"></i> </button>
																							<button type="submit" class="btn btn-warning btn-sm btn-rounded" data-toggle="modal" data-target="#catat_jabatan<?=$jabatan->id?>"> <i class="ti-pencil"></i> </button>
																							<?php endif; ?>
																							<button type="submit" class="btn btn-danger btn-sm btn-rounded" data-toggle="modal" data-target="#delete_jabatan<?=$jabatan->id?>"><i class="ti-trash"></i></button>
																						</td>
																				</tr>
																				<!-- verif row -->
						                            <div class="modal fade bs-example-modal-sm" id="verif_jabatan<?=$jabatan->id?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
						                                <div class="modal-dialog modal-sm">
						                                    <div class="modal-content">
						                                        <div class="modal-header" style="background-color:#008efa">
						                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						                                            <h4 class="modal-title" id="myLargeModalLabel" style="color:white">Alert !</h4>
						                                        </div>
						                                        <div class="modal-body">
																											Apakah anda yakin akan memverifikasi data ini ?
						                                        </div>
						                                        <div class="modal-footer">
																											<form method="post">
																												<input type="hidden" name="id_jabatan" value="<?=$jabatan->id?>">
																												<button type="submit" class="btn btn-danger waves-effect text-left" name="verif_jabatan" >Verifikasi</button>
																											</form>
						                                            <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Batal</button>
						                                        </div>
						                                    </div>
						                                    <!-- /.modal-content -->
						                                </div>
						                                <!-- /.modal-dialog -->
						                            </div>
																				<!-- catat row -->
						                            <div class="modal fade bs-example-modal-md" id="catat_jabatan<?=$jabatan->id?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
						                                <div class="modal-dialog modal-md">
						                                    <div class="modal-content">
						                                        <div class="modal-header" style="background-color:#f0ad4e">
						                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						                                            <h4 class="modal-title" id="myLargeModalLabel" style="color:white">Alert !</h4>
						                                        </div>
																										<form method="post">
																											<input type="hidden" name="id_jabatan" value="<?=$jabatan->id?>">
						                                        <div class="modal-body">
																											Catatan :
																											<textarea name="catatan_verifikasi" class="form-control" rows="8" cols="80"></textarea>
						                                        </div>
						                                        <div class="modal-footer">
																												<button type="submit" class="btn btn-danger waves-effect text-left" name="catat_jabatan" >Verifikasi</button>
						                                            <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Batal</button>
						                                        </div>
																										</form>
						                                    </div>
						                                    <!-- /.modal-content -->
						                                </div>
						                                <!-- /.modal-dialog -->
						                            </div>
																				<!-- sample modal content -->
						                            <div class="modal fade bs-example-modal-sm" id="delete_jabatan<?=$jabatan->id?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
						                                <div class="modal-dialog modal-sm">
						                                    <div class="modal-content">
						                                        <div class="modal-header" style="background-color:#f75b36">
						                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						                                            <h4 class="modal-title" id="myLargeModalLabel" style="color:white">Alert !</h4>
						                                        </div>
						                                        <div class="modal-body">
																											Apakah anda yakin akan menghapus data ini ?
						                                        </div>
						                                        <div class="modal-footer">
																											<form method="post">
																												<input type="hidden" name="id_jabatan" value="<?=$jabatan->id?>">
																												<button type="submit" class="btn btn-danger waves-effect text-left" name="delete_jabatan" >Hapus</button>
																											</form>
						                                            <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Batal</button>
						                                        </div>
						                                    </div>
						                                    <!-- /.modal-content -->
						                                </div>
						                                <!-- /.modal-dialog -->
						                            </div>
																			<?php endforeach; ?>
																		</tbody>
																</table>
														</div>
	                    </div>
											<div id="form_riwayat_jabatan">
												<button type="button" id="lihat_riwayat_jabatan" class="btn btn-primary">Lihat Riwayat Jabatan</button>
												<hr>
												<form method="post">
													<input type="hidden" name="nip" value="<?=$data_by_bkd->nip?>">
													<div class="form-group">
														<label for="">Jenis Jabatan</label>
														<select class="form-control" name="jenis_jabatan_sementara" id="jenis_jabatan" onchange="getJabatan()">
															<option value='' selected>Pilih</option>
                              <option value='1'>Struktural</option>
															<option value='2'>Fungsional</option>
														</select>
													</div>
													<div class="form-group">
														<label for="">Jabatan</label>
														<input type="text" class="form-control" name="nama_jabatan_sementara" value="">
													</div>
													<div class="form-group">
														<label for="">Eselon</label>
														<select disabled class="form-control" name="id_eselon" id='id_eselon'>
															<option value='' selected>Pilih</option>
															<?php
																foreach($eselon as $row){
																	echo "<option value='$row->id_eselon'>$row->nama_eselon</option>";
																}
																?>
														</select>
													</div>

													<div class="form-group">
														<label for="">Golongan</label>
														<select class="form-control" name="id_golongan" id='id_golongan_jb'>
															<option value='' selected>Pilih</option>
															<?php
															foreach ($golongan as $row ){
																echo "<option value='$row->id_golongan'>$row->pangkat, $row->golongan</option>";
															}
															?>
														</select>
													</div>
													<div class="form-group">
														<label for="">Tgl. Mulai</label>
														<input type="date"  class="form-control"name="tgl_mulai" value="">
													</div>
													<div class="form-group">
														<label for="">Tgl. Akhir</label>
														<input type="date"  class="form-control" id="tgl_akhir" name="tgl_akhir" value="">
														<input type="checkbox" value="0" id="tgl_akhir_cek" name="tgl_akhir_cek" value="" onclick='current_histoty("tgl_akhir_cek","tgl_akhir")'> Sampai Sekarang
													</div>
													<div class="form-group">
														<label for="">Gaji Pokok</label>
														<input type="number" class="form-control" name="gaji_pokok" value="">
													</div>
													<div class="form-group">
														<label for="">Nama Pejabat</label>
														<input type="text" class="form-control" name="nama_pejabat" value="">
													</div>
													<div class="form-group">
														<label for="">Nomor SK</label>
														<input type="number"  class="form-control" name="no_sk" value="">
													</div>
													<div class="form-group">
														<label for="">Tgl SK</label>
														<input type="date" class="form-control"  name="tgl_sk" value="">
													</div>
													<div class="form-group">
														<label for="">NUPTK</label>
														<input type="text"  class="form-control" name="nuptk" value="">
													</div>
													<hr>
													<button type="submit" class="btn btn-primary" name="submit_jabatan">Simpan`</button>
												</form>
											</div>
											</div>
                    <div role="tabpanel" class="tab-pane fade" id="pendidikan1">
											<div id="table_riwayat_pendidikan">
												<button type="button" id="tambah_riwayat_pendidikan" class="btn btn-primary">Tambah Riwayat Pendidikan</button>
												<hr>
												<div class="table-responsive">
																<table class="table color-table primary-table">
																		<thead>
																				<tr>
																						<th>#</th>
																						<th>Jenjang</th>
																						<th>Nama Sekolah</th>
																						<th>Jurusan</th>
																						<th>Nama Pejabat</th>
																						<th>No. SK</th>
																						<th>Tgl. SK</th>
																						<th>Status</th>
																						<th>Aksi</th>
																				</tr>
																		</thead>
																		<tbody>
																			<?php foreach ($data_pendidikan as $pendidikan): ?>
																				<tr>
																						<td>1</td>
																						<td><?=isset($pendidikan) ? $pendidikan->nama_jenjangpendidikan : "" ?></td>
																						<td><?=isset($pendidikan) ? $pendidikan->nama_tempatpendidikan : "" ?></td>
																						<td><?=isset($pendidikan) ? $pendidikan->nama_jurusan : "" ?></td>
																						<td><?=isset($pendidikan) ? $pendidikan->nama_pejabat : "" ?></td>
																						<td><?=isset($pendidikan) ? $pendidikan->nomor_sk : "" ?></td>
																						<td><?=isset($pendidikan) ? tanggal($pendidikan->tgl_sk) : "" ?></td>
																						<td>
																							<?php if ($pendidikan->verifikasi_pegawai == "true" && $pendidikan->verifikasi_bkd == "true"): ?>
																								<span class="label label-success">Sudah Diverifikasi</span>
																								<?php else: ?>
																								<span class="label label-danger">Belum Diverifikasi oleh Pegawai / BKD</span>
																							<?php endif; ?>
																						</td>
																						<td>
																							<?php if ($pendidikan->verifikasi_bkd == false): ?>
																							<button type="submit" class="btn btn-info btn-sm btn-rounded" data-toggle="modal" data-target="#verif_pendidikan<?=$pendidikan->id?>"> <i class="ti-check"></i> </button>
																							<button type="submit" class="btn btn-warning btn-sm btn-rounded" data-toggle="modal" data-target="#catat_pendidikan<?=$pendidikan->id?>"> <i class="ti-pencil"></i> </button>
																							<?php endif; ?>
																							<button type="submit" class="btn btn-danger btn-sm btn-rounded" data-toggle="modal" data-target="#delete_pendidikan<?=$pendidikan->id?>"><i class="ti-trash"></i></button>
																						</td>
																				</tr>
																				<!-- verif row -->
						                            <div class="modal fade bs-example-modal-sm" id="verif_pendidikan<?=$pendidikan->id?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
						                                <div class="modal-dialog modal-sm">
						                                    <div class="modal-content">
						                                        <div class="modal-header" style="background-color:#008efa">
						                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						                                            <h4 class="modal-title" id="myLargeModalLabel" style="color:white">Alert !</h4>
						                                        </div>
						                                        <div class="modal-body">
																											Apakah anda yakin akan memverifikasi data ini ?
						                                        </div>
						                                        <div class="modal-footer">
																											<form method="post">
																												<input type="hidden" name="id_pendidikan" value="<?=$pendidikan->id?>">
																												<button type="submit" class="btn btn-danger waves-effect text-left" name="verif_pendidikan" >Verifikasi</button>
																											</form>
						                                            <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Batal</button>
						                                        </div>
						                                    </div>
						                                    <!-- /.modal-content -->
						                                </div>
						                                <!-- /.modal-dialog -->
						                            </div>
																				<!-- catat row -->
						                            <div class="modal fade bs-example-modal-md" id="catat_pendidikan<?=$pendidikan->id?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
						                                <div class="modal-dialog modal-md">
						                                    <div class="modal-content">
						                                        <div class="modal-header" style="background-color:#f0ad4e">
						                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						                                            <h4 class="modal-title" id="myLargeModalLabel" style="color:white">Alert !</h4>
						                                        </div>
																										<form method="post">
																											<input type="hidden" name="id_pendidikan" value="<?=$pendidikan->id?>">
						                                        <div class="modal-body">
																											Catatan :
																											<textarea name="catatan_verifikasi" class="form-control" rows="8" cols="80"></textarea>
						                                        </div>
						                                        <div class="modal-footer">
																												<button type="submit" class="btn btn-danger waves-effect text-left" name="catat_pendidikan" >Verifikasi</button>
						                                            <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Batal</button>
						                                        </div>
																										</form>
						                                    </div>
						                                    <!-- /.modal-content -->
						                                </div>
						                                <!-- /.modal-dialog -->
						                            </div>
																				<!-- sample modal content -->
						                            <div class="modal fade bs-example-modal-sm" id="delete_pendidikan<?=$pendidikan->id?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
						                                <div class="modal-dialog modal-sm">
						                                    <div class="modal-content">
						                                        <div class="modal-header" style="background-color:#f75b36">
						                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						                                            <h4 class="modal-title" id="myLargeModalLabel" style="color:white">Alert !</h4>
						                                        </div>
						                                        <div class="modal-body">
																											Apakah anda yakin akan menghapus data ini ?
						                                        </div>
						                                        <div class="modal-footer">
																											<form method="post">
																												<input type="hidden" name="id_pendidikan" value="<?=$pendidikan->id?>">
																												<button type="submit" class="btn btn-danger waves-effect text-left" name="delete_pendidikan" >Hapus</button>
																											</form>
						                                            <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Batal</button>
						                                        </div>
						                                    </div>
						                                    <!-- /.modal-content -->
						                                </div>
						                                <!-- /.modal-dialog -->
						                            </div>
																			<?php endforeach; ?>
																		</tbody>
																</table>
														</div>
											</div>
											<div id="form_riwayat_pendidikan">
												<button type="button" id="lihat_riwayat_pendidikan" class="btn btn-primary">Lihat Riwayat Pendidikan</button>
												<hr>
												<form method="post">
													<input type="hidden" name="nip" value="<?=$data_by_bkd->nip?>">
													<div class="form-group">
														<label for="">Jenjang</label>
														<select class="form-control" name="id_jenjangpendidikan">
															<option value="">Pilih</option>
															<?php
															foreach ($jenjangpendidikan as $row){
																echo "<option value='$row->id_jenjangpendidikan'>$row->nama_jenjangpendidikan</option>";
															}
															?>
														</select>
													</div>
													<div class="form-group">
														<label for="">Nama Sekolah / Universitas</label>
														<select class="form-control select2" name="id_tempatpendidikan">
															<option value="">Pilih</option>
															<?php
															foreach ($tempatpendidikan as $row){
																echo "<option value='$row->id_tempatpendidikan'>$row->nama_tempatpendidikan</option>";
															}
															?>
														</select>
													</div>
													<div class="form-group">
														<label for="">Jurusan</label>
														<select class="form-control select2" name="id_jurusan">
															<option value="">Pilih</option>
															<?php
															foreach ($jurusan as $row){
																echo "<option value='$row->id_jurusan'>$row->nama_jurusan</option>";
															}
															?>
														</select>
													</div>
													<div class="form-group">
														<label for="">Nama Pejabat</label>
														<input type="text" class="form-control" name="nama_pejabat" value="">
													</div>
													<div class="form-group">
														<label for="">No SK/Ijazah</label>
														<input type="number" class="form-control" name="nomor_sk" value="">
													</div>
													<div class="form-group">
														<label for="">Tanggal SK/Ijazah</label>
														<input type="date" class="form-control" name="tgl_sk" value="">
													</div>
													<hr>
													<button type="submit" class="btn btn-primary" name="submit_pendidikan">Simpan</button>
												</form>
											</div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="latihan1">
											<div id="table_riwayat_diklat">
												<button type="button" id="tambah_riwayat_diklat" class="btn btn-primary">Tambah Riwayat Diklat</button>
												<hr>
												<div class="table-responsive">
																<table class="table color-table primary-table">
																		<thead>
																				<tr>
																						<th>#</th>
																						<th>Jenis Diklat</th>
																						<th>Nama Diklat</th>
																						<th>Tempat</th>
																						<th>Penyelengara</th>
																						<th>Angkatan</th>
																						<th>Tgl. Mulai</th>
																						<th>Tgl. Akhir</th>
																						<th>No. SPTL</th>
																						<th>Tahun</th>
																						<th>Status</th>
																						<th>Aksi</th>
																				</tr>
																		</thead>
																		<tbody>
																			<?php foreach ($data_diklat as $diklat): ?>
																				<tr>
																						<td>1</td>
																						<td><?=isset($diklat) ? $diklat->nama_jenisdiklat : "" ?></td>
																						<td><?=isset($diklat) ? $diklat->nama_diklat : "" ?></td>
																						<td><?=isset($diklat) ? $diklat->tempat : "" ?></td>
																						<td><?=isset($diklat) ? $diklat->penyelenggara : "" ?></td>
																						<td><?=isset($diklat) ? $diklat->angkatan : "" ?></td>
																						<td><?=isset($diklat) ? tanggal($diklat->tgl_mulai) : "" ?></td>
																						<td><?=isset($diklat) ? tanggal($diklat->tgl_akhir) : "" ?></td>
																						<td><?=isset($diklat) ? $diklat->no_sptl : "" ?></td>
																						<td><?=isset($diklat) ? tanggal($diklat->tgl_sptl) : "" ?></td>
																						<td>
																							<?php if ($diklat->verifikasi_pegawai == "true" && $diklat->verifikasi_bkd == "true"): ?>
																								<span class="label label-success">Sudah Diverifikasi</span>
																								<?php else: ?>
																								<span class="label label-danger">Belum Diverifikasi oleh Pegawai / BKD</span>
																							<?php endif; ?>
																						</td>
																						<td>
																							<?php if ($diklat->verifikasi_bkd == false): ?>
																							<button type="submit" class="btn btn-info btn-sm btn-rounded" data-toggle="modal" data-target="#verif_diklat<?=$diklat->id?>"> <i class="ti-check"></i> </button>
																							<button type="submit" class="btn btn-warning btn-sm btn-rounded" data-toggle="modal" data-target="#catat_diklat<?=$diklat->id?>"> <i class="ti-pencil"></i> </button>
																							<?php endif; ?>
																							<button type="submit" class="btn btn-danger btn-sm btn-rounded" data-toggle="modal" data-target="#delete_diklat<?=$diklat->id?>"><i class="ti-trash"></i></button>
																						</td>
																				</tr>
																				<!-- verif row -->
						                            <div class="modal fade bs-example-modal-sm" id="verif_diklat<?=$diklat->id?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
						                                <div class="modal-dialog modal-sm">
						                                    <div class="modal-content">
						                                        <div class="modal-header" style="background-color:#008efa">
						                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						                                            <h4 class="modal-title" id="myLargeModalLabel" style="color:white">Alert !</h4>
						                                        </div>
						                                        <div class="modal-body">
																											Apakah anda yakin akan memverifikasi data ini ?
						                                        </div>
						                                        <div class="modal-footer">
																											<form method="post">
																												<input type="hidden" name="id_diklat" value="<?=$diklat->id?>">
																												<button type="submit" class="btn btn-danger waves-effect text-left" name="verif_diklat" >Verifikasi</button>
																											</form>
						                                            <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Batal</button>
						                                        </div>
						                                    </div>
						                                    <!-- /.modal-content -->
						                                </div>
						                                <!-- /.modal-dialog -->
						                            </div>
																				<!-- catat row -->
						                            <div class="modal fade bs-example-modal-md" id="catat_diklat<?=$diklat->id?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
						                                <div class="modal-dialog modal-md">
						                                    <div class="modal-content">
						                                        <div class="modal-header" style="background-color:#f0ad4e">
						                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						                                            <h4 class="modal-title" id="myLargeModalLabel" style="color:white">Alert !</h4>
						                                        </div>
																										<form method="post">
																											<input type="hidden" name="id_diklat" value="<?=$diklat->id?>">
						                                        <div class="modal-body">
																											Catatan :
																											<textarea name="catatan_verifikasi" class="form-control" rows="8" cols="80"></textarea>
						                                        </div>
						                                        <div class="modal-footer">
																												<button type="submit" class="btn btn-danger waves-effect text-left" name="catat_diklat" >Verifikasi</button>
						                                            <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Batal</button>
						                                        </div>
																										</form>
						                                    </div>
						                                    <!-- /.modal-content -->
						                                </div>
						                                <!-- /.modal-dialog -->
						                            </div>
																				<!-- sample modal content -->
						                            <div class="modal fade bs-example-modal-sm" id="delete_diklat<?=$diklat->id?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
						                                <div class="modal-dialog modal-sm">
						                                    <div class="modal-content">
						                                        <div class="modal-header" style="background-color:#f75b36">
						                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						                                            <h4 class="modal-title" id="myLargeModalLabel" style="color:white">Alert !</h4>
						                                        </div>
						                                        <div class="modal-body">
																											Apakah anda yakin akan menghapus data ini ?
						                                        </div>
						                                        <div class="modal-footer">
																											<form method="post">
																												<input type="hidden" name="id_diklat" value="<?=$diklat->id?>">
																												<button type="submit" class="btn btn-danger waves-effect text-left" name="delete_diklat" >Hapus</button>
																											</form>
						                                            <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Batal</button>
						                                        </div>
						                                    </div>
						                                    <!-- /.modal-content -->
						                                </div>
						                                <!-- /.modal-dialog -->
						                            </div>
																			<?php endforeach; ?>
																		</tbody>
																</table>
														</div>
														<hr>
											</div>
											<div id="form_riwayat_diklat">
												<button type="button" id="lihat_riwayat_diklat" class="btn btn-primary">Lihat Riwayat Diklat</button>
												<hr>
												<form method="post">
													<input type="hidden" name="nip" value="<?=$data_by_bkd->nip?>">
													<div class="form-group">
														<label for="">Jenis</label>
														<select class="form-control" name="id_jenisdiklat">
															<option value="">Pilih</option>
															<?php
															foreach($jenisdiklat as $row)
															{
																echo "<option value='$row->id_jenisdiklat'>$row->nama_jenisdiklat</option>";
															}
															?>
														</select>
													</div>
													<div class="form-group">
														<label for="">Nama</label>
														<input type="text" class="form-control" name="nama_diklat" value="">
													</div>
													<div class="form-group">
														<label for="">Tempat</label>
														<input type="text" class="form-control" name="tempat" value="">
													</div>
													<div class="form-group">
														<label for="">Penyelengara</label>
														<input type="text" class="form-control" name="penyelenggara" value="">
													</div>
													<div class="form-group">
														<label for="">Angkatan</label>
														<input type="number" class="form-control" name="angkatan" value="">
													</div>
													<div class="form-group">
														<label for="">Tgl. Mulai</label>
														<input type="date" class="form-control" name="tgl_mulai" value="">
													</div>
													<div class="form-group">
														<label for="">Tgl. Akhir</label>
														<input type="date" class="form-control" name="tgl_akhir" value="">
													</div>
													<div class="form-group">
														<label for="">No. SPTL</label>
														<input type="text" class="form-control" name="no_sptl" value="">
													</div>
													<div class="form-group">
														<label for="">Tgl. SPTL</label>
														<input type="date" class="form-control" name="tgl_sptl" value="">
													</div>
													<hr>
													<button type="submit" class="btn btn-primary" name="submit_diklat">Simpan</button>
												</form>
												<hr>
											</div>
											<div id="table_riwayat_penataran">
												<button type="button" id="tambah_riwayat_penataran" class="btn btn-primary">Tambah Riwayat Penataran</button>
												<hr>
												<div class="table-responsive">
																<table class="table color-table primary-table">
																		<thead>
																				<tr>
																						<th>#</th>
																						<th>Jenis Penataran</th>
																						<th>Nama Penataran</th>
																						<th>Tempat</th>
																						<th>Penyelengara</th>
																						<th>Angkatan</th>
																						<th>Tgl. Mulai</th>
																						<th>Tgl. Akhir</th>
																						<th>No. SPTL</th>
																						<th>Tahun</th>
																						<th>Status</th>
																						<th>Aksi</th>
																				</tr>
																		</thead>
																		<tbody>
																			<?php foreach ($data_penataran as $penataran): ?>
																				<tr>
																						<td>1</td>
																						<td><?=isset($penataran) ? $penataran->nama_penataran : "" ?></td>
																						<td><?=isset($penataran) ? $penataran->nama_riwayat_penataran : "" ?></td>
																						<td><?=isset($penataran) ? $penataran->tempat : "" ?></td>
																						<td><?=isset($penataran) ? $penataran->penyelenggara : "" ?></td>
																						<td><?=isset($penataran) ? $penataran->angkatan : "" ?></td>
																						<td><?=isset($penataran) ? tanggal($penataran->tgl_mulai_penataran) : "" ?></td>
																						<td><?=isset($penataran) ? tanggal($penataran->tgl_akhir_penataran) : "" ?></td>
																						<td><?=isset($penataran) ? $penataran->nomer_stpl : "" ?></td>
																						<td><?=isset($penataran) ? tanggal($penataran->tgl_stpl) : "" ?></td>
																						<td>
																							<?php if ($penataran->verifikasi_pegawai == "true" && $penataran->verifikasi_bkd == "true"): ?>
																								<span class="label label-success">Sudah Diverifikasi</span>
																								<?php else: ?>
																								<span class="label label-danger">Belum Diverifikasi oleh Pegawai / BKD</span>
																							<?php endif; ?>
																						</td>
																						<td>
																							<?php if ($penataran->verifikasi_bkd == false): ?>
																							<button type="submit" class="btn btn-info btn-sm btn-rounded" data-toggle="modal" data-target="#verif_penataran<?=$penataran->id?>"> <i class="ti-check"></i> </button>
																							<button type="submit" class="btn btn-warning btn-sm btn-rounded" data-toggle="modal" data-target="#catat_penataran<?=$penataran->id?>"> <i class="ti-pencil"></i> </button>
																							<?php endif; ?>
																							<button type="submit" class="btn btn-danger btn-sm btn-rounded" data-toggle="modal" data-target="#delete_penataran<?=$penataran->id?>"><i class="ti-trash"></i></button>
																						</td>
																				</tr>
																				<!-- verif row -->
						                            <div class="modal fade bs-example-modal-sm" id="verif_penataran<?=$penataran->id?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
						                                <div class="modal-dialog modal-sm">
						                                    <div class="modal-content">
						                                        <div class="modal-header" style="background-color:#008efa">
						                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						                                            <h4 class="modal-title" id="myLargeModalLabel" style="color:white">Alert !</h4>
						                                        </div>
						                                        <div class="modal-body">
																											Apakah anda yakin akan memverifikasi data ini ?
						                                        </div>
						                                        <div class="modal-footer">
																											<form method="post">
																												<input type="hidden" name="id_penataran" value="<?=$penataran->id?>">
																												<button type="submit" class="btn btn-danger waves-effect text-left" name="verif_penataran" >Verifikasi</button>
																											</form>
						                                            <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Batal</button>
						                                        </div>
						                                    </div>
						                                    <!-- /.modal-content -->
						                                </div>
						                                <!-- /.modal-dialog -->
						                            </div>
																				<!-- catat row -->
						                            <div class="modal fade bs-example-modal-md" id="catat_penataran<?=$penataran->id?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
						                                <div class="modal-dialog modal-md">
						                                    <div class="modal-content">
						                                        <div class="modal-header" style="background-color:#f0ad4e">
						                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						                                            <h4 class="modal-title" id="myLargeModalLabel" style="color:white">Alert !</h4>
						                                        </div>
																										<form method="post">
																											<input type="hidden" name="id_penataran" value="<?=$penataran->id?>">
						                                        <div class="modal-body">
																											Catatan :
																											<textarea name="catatan_verifikasi" class="form-control" rows="8" cols="80"></textarea>
						                                        </div>
						                                        <div class="modal-footer">
																												<button type="submit" class="btn btn-danger waves-effect text-left" name="catat_penataran" >Verifikasi</button>
						                                            <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Batal</button>
						                                        </div>
																										</form>
						                                    </div>
						                                    <!-- /.modal-content -->
						                                </div>
						                                <!-- /.modal-dialog -->
						                            </div>
																				<!-- sample modal content -->
																				<div class="modal fade bs-example-modal-sm" id="delete_penataran<?=$penataran->id?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
																					<div class="modal-dialog modal-sm">
																						<div class="modal-content">
																							<div class="modal-header" style="background-color:#f75b36">
																								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
																								<h4 class="modal-title" id="myLargeModalLabel" style="color:white">Alert !</h4>
																							</div>
																							<div class="modal-body">
																																		Apakah anda yakin akan menghapus data ini ?
																							</div>
																							<div class="modal-footer">
																										<form method="post">
																											<input type="hidden" name="id_penataran" value="<?=$penataran->id?>">
																											<button type="submit" class="btn btn-danger waves-effect text-left" name="delete_penataran" >Hapus</button>
																										</form>
																								<button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Batal</button>
																							</div>
																						</div>
																						<!-- /.modal-content -->
																					</div>
																					<!-- /.modal-dialog -->
																				</div>
																			<?php endforeach; ?>
																		</tbody>
																</table>
														</div>
														<hr>
											</div>
											<div id="form_riwayat_penataran">
												<button type="button" id="lihat_riwayat_penataran" class="btn btn-primary">Lihat Riwayat Penataran</button>
												<hr>
												<form method="post">
													<div class="form-group">
														<label for="">Jenis</label>
														<select class="form-control" name="id_penataran">
															<option value="">Pilih</option>
															<?php
															foreach($jenispenataran as $row)
															{
																echo "<option value='$row->id_penataran'>$row->nama_penataran</option>";
															}
															?>
														</select>
													</div>
													<div class="form-group">
														<label for="">Nama</label>
														<input type="text" class="form-control" name="nama_riwayat_penataran" value="">
													</div>
													<div class="form-group">
														<label for="">Tempat</label>
														<input type="text" class="form-control" name="tempat" value="">
													</div>
													<div class="form-group">
														<label for="">Penyelengara</label>
														<input type="text" class="form-control" name="penyelenggara" value="">
													</div>
													<div class="form-group">
														<label for="">Angkatan</label>
														<input type="number" class="form-control" name="angkatan" value="">
													</div>
													<div class="form-group">
														<label for="">Tgl. Mulai</label>
														<input type="date" class="form-control" name="tgl_mulai_penataran" value="">
													</div>
													<div class="form-group">
														<label for="">Tgl. Akhir</label>
														<input type="date" class="form-control" name="tgl_akhir_penataran" value="">
													</div>
													<div class="form-group">
														<label for="">No. SPTL</label>
														<input type="number" class="form-control" name="nomer_stpl" value="">
													</div>
													<div class="form-group">
														<label for="">Tgl. SPTL</label>
														<input type="date" class="form-control" name="tgl_stpl" value="">
													</div>
													<hr>
													<button type="submit" class="btn btn-primary" name="submit_penataran">Simpan</button>
												</form>
												<hr>
											</div>
											<div id="table_riwayat_seminar">
												<button type="button" id="tambah_riwayat_seminar" class="btn btn-primary">Tambah Riwayat Seminar</button>
												<hr>
												<div class="table-responsive">
																<table class="table color-table primary-table">
																		<thead>
																				<tr>
																						<th>#</th>
																						<th>Jenis Seminar</th>
																						<th>Nama Seminar</th>
																						<th>Tempat</th>
																						<th>Penyelengara</th>
																						<th>Angkatan</th>
																						<th>Tgl. Mulai</th>
																						<th>Tgl. Akhir</th>
																						<th>No. SPTL</th>
																						<th>Tahun</th>
																						<th>Status</th>
																						<th>Aksi</th>
																				</tr>
																		</thead>
																		<tbody>
																			<?php foreach ($data_seminar as $seminar): ?>
																				<tr>
																						<td>1</td>
																						<td><?=isset($seminar) ? $seminar->nama_jenisseminar : "" ?></td>
																						<td><?=isset($seminar) ? $seminar->nama_riwayat_seminar : "" ?></td>
																						<td><?=isset($seminar) ? $seminar->tempat : "" ?></td>
																						<td><?=isset($seminar) ? $seminar->penyelenggara : "" ?></td>
																						<td><?=isset($seminar) ? $seminar->angkatan : "" ?></td>
																						<td><?=isset($seminar) ? tanggal($seminar->tgl_mulai_seminar) : "" ?></td>
																						<td><?=isset($seminar) ? tanggal($seminar->tgl_akhir_seminar) : "" ?></td>
																						<td><?=isset($seminar) ? $seminar->nomer_stpl : "" ?></td>
																						<td><?=isset($seminar) ? tanggal($seminar->tgl_stpl) : "" ?></td>
																						<td>
																							<?php if ($seminar->verifikasi_pegawai == "true" && $seminar->verifikasi_bkd == "true"): ?>
																								<span class="label label-success">Sudah Diverifikasi</span>
																								<?php else: ?>
																								<span class="label label-danger">Belum Diverifikasi oleh Pegawai / BKD</span>
																							<?php endif; ?>
																						</td>
																						<td>
																							<?php if ($seminar->verifikasi_bkd == false): ?>
																							<button type="submit" class="btn btn-info btn-sm btn-rounded" data-toggle="modal" data-target="#verif_seminar<?=$seminar->id?>"> <i class="ti-check"></i> </button>
																							<button type="submit" class="btn btn-warning btn-sm btn-rounded" data-toggle="modal" data-target="#catat_seminar<?=$seminar->id?>"> <i class="ti-pencil"></i> </button>
																							<?php endif; ?>
																							<button type="submit" class="btn btn-danger btn-sm btn-rounded" data-toggle="modal" data-target="#delete_seminar<?=$seminar->id?>"><i class="ti-trash"></i></button>
																						</td>
																				</tr>
																				<!-- verif row -->
						                            <div class="modal fade bs-example-modal-sm" id="verif_seminar<?=$seminar->id?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
						                                <div class="modal-dialog modal-sm">
						                                    <div class="modal-content">
						                                        <div class="modal-header" style="background-color:#008efa">
						                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						                                            <h4 class="modal-title" id="myLargeModalLabel" style="color:white">Alert !</h4>
						                                        </div>
						                                        <div class="modal-body">
																											Apakah anda yakin akan memverifikasi data ini ?
						                                        </div>
						                                        <div class="modal-footer">
																											<form method="post">
																												<input type="hidden" name="id_seminar" value="<?=$seminar->id?>">
																												<button type="submit" class="btn btn-danger waves-effect text-left" name="verif_seminar" >Verifikasi</button>
																											</form>
						                                            <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Batal</button>
						                                        </div>
						                                    </div>
						                                    <!-- /.modal-content -->
						                                </div>
						                                <!-- /.modal-dialog -->
						                            </div>
																				<!-- catat row -->
						                            <div class="modal fade bs-example-modal-md" id="catat_seminar<?=$seminar->id?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
						                                <div class="modal-dialog modal-md">
						                                    <div class="modal-content">
						                                        <div class="modal-header" style="background-color:#f0ad4e">
						                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						                                            <h4 class="modal-title" id="myLargeModalLabel" style="color:white">Alert !</h4>
						                                        </div>
																										<form method="post">
																											<input type="hidden" name="id_seminar" value="<?=$seminar->id?>">
						                                        <div class="modal-body">
																											Catatan :
																											<textarea name="catatan_verifikasi" class="form-control" rows="8" cols="80"></textarea>
						                                        </div>
						                                        <div class="modal-footer">
																												<button type="submit" class="btn btn-danger waves-effect text-left" name="catat_seminar" >Verifikasi</button>
						                                            <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Batal</button>
						                                        </div>
																										</form>
						                                    </div>
						                                    <!-- /.modal-content -->
						                                </div>
						                                <!-- /.modal-dialog -->
						                            </div>
																				<!-- sample modal content -->
																				<div class="modal fade bs-example-modal-sm" id="delete_seminar<?=$seminar->id?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
																					<div class="modal-dialog modal-sm">
																						<div class="modal-content">
																							<div class="modal-header" style="background-color:#f75b36">
																								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
																								<h4 class="modal-title" id="myLargeModalLabel" style="color:white">Alert !</h4>
																							</div>
																							<div class="modal-body">
																																		Apakah anda yakin akan menghapus data ini ?
																							</div>
																							<div class="modal-footer">
																										<form method="post">
																											<input type="hidden" name="id_seminar" value="<?=$seminar->id?>">
																											<button type="submit" class="btn btn-danger waves-effect text-left" name="delete_seminar" >Hapus</button>
																										</form>
																								<button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Batal</button>
																							</div>
																						</div>
																						<!-- /.modal-content -->
																					</div>
																					<!-- /.modal-dialog -->
																				</div>
																			<?php endforeach; ?>
																		</tbody>
																</table>
														</div>
														<hr>
											</div>
											<div id="form_riwayat_seminar">
												<button type="button" id="lihat_riwayat_seminar" class="btn btn-primary">Lihat Riwayat Seminar</button>
												<hr>
												<form method="post">
													<div class="form-group">
														<label for="">Jenis</label>
														<select class="form-control" name="id_jenisseminar">
															<option value="">Pilih</option>
															<?php
															foreach($jenisseminar as $row)
															{
																echo "<option value='$row->id_jenisseminar'>$row->nama_jenisseminar</option>";
															}
															?>
														</select>
													</div>
													<div class="form-group">
														<label for="">Nama</label>
														<input type="text" class="form-control" name="nama_riwayat_seminar" value="">
													</div>
													<div class="form-group">
														<label for="">Tempat</label>
														<input type="text" class="form-control" name="tempat" value="">
													</div>
													<div class="form-group">
														<label for="">Penyelengara</label>
														<input type="text" class="form-control" name="penyelenggara" value="">
													</div>
													<div class="form-group">
														<label for="">Angkatan</label>
														<input type="number" class="form-control" name="angkatan" value="">
													</div>
													<div class="form-group">
														<label for="">Tgl. Mulai</label>
														<input type="date" class="form-control" name="tgl_mulai_seminar" value="">
													</div>
													<div class="form-group">
														<label for="">Tgl. Akhir</label>
														<input type="date" class="form-control" name="tgl_akhir_seminar" value="">
													</div>
													<div class="form-group">
														<label for="">No. SPTL</label>
														<input type="number" class="form-control" name="nomer_stpl" value="">
													</div>
													<div class="form-group">
														<label for="">Tgl. SPTL</label>
														<input type="date" class="form-control" name="tgl_stpl" value="">
													</div>
													<hr>
													<button type="submit" class="btn btn-primary" name="submit_seminar">Simpan</button>
												</form>
												<hr>
											</div>
											<div id="table_riwayat_kursus">
												<button type="button" id="tambah_riwayat_kursus" class="btn btn-primary">Tambah Riwayat Kursus</button>
												<hr>
												<div class="table-responsive">
																<table class="table color-table primary-table">
																		<thead>
																				<tr>
																						<th>#</th>
																						<th>Jenis Kursus</th>
																						<th>Nama Kursus</th>
																						<th>Tempat</th>
																						<th>Penyelengara</th>
																						<th>Angkatan</th>
																						<th>Tgl. Mulai</th>
																						<th>Tgl. Akhir</th>
																						<th>No. SPTL</th>
																						<th>Tahun</th>
																						<th>Status</th>
																						<th>Aksi</th>
																				</tr>
																		</thead>
																		<tbody>
																			<?php foreach ($data_kursus as $kursus): ?>
																				<tr>
																						<td>1</td>
																						<td><?=isset($kursus) ? $kursus->nama_kursus : "" ?></td>
																						<td><?=isset($kursus) ? $kursus->nama_riwayat_kursus : "" ?></td>
																						<td><?=isset($kursus) ? $kursus->tempat : "" ?></td>
																						<td><?=isset($kursus) ? $kursus->penyelenggara : "" ?></td>
																						<td><?=isset($kursus) ? $kursus->angkatan : "" ?></td>
																						<td><?=isset($kursus) ? tanggal($kursus->tgl_mulai_kursus) : "" ?></td>
																						<td><?=isset($kursus) ? tanggal($kursus->tgl_akhir_kursus) : "" ?></td>
																						<td><?=isset($kursus) ? $kursus->nomer_stpl : "" ?></td>
																						<td><?=isset($kursus) ? tanggal($kursus->tgl_stpl) : "" ?></td>
																						<td>
																							<?php if ($kursus->verifikasi_pegawai == "true" && $kursus->verifikasi_bkd == "true"): ?>
																								<span class="label label-success">Sudah Diverifikasi</span>
																								<?php else: ?>
																								<span class="label label-danger">Belum Diverifikasi oleh Pegawai / BKD</span>
																							<?php endif; ?>
																						</td>
																						<td>
																							<?php if ($kursus->verifikasi_bkd == false): ?>
																							<button type="submit" class="btn btn-info btn-sm btn-rounded" data-toggle="modal" data-target="#verif_kursus<?=$kursus->id?>"> <i class="ti-check"></i> </button>
																							<button type="submit" class="btn btn-warning btn-sm btn-rounded" data-toggle="modal" data-target="#catat_kursus<?=$kursus->id?>"> <i class="ti-pencil"></i> </button>
																							<?php endif; ?>
																							<button type="submit" class="btn btn-danger btn-sm btn-rounded" data-toggle="modal" data-target="#delete_kursus<?=$kursus->id?>"><i class="ti-trash"></i></button>
																						</td>
																				</tr>
																				<!-- verif row -->
						                            <div class="modal fade bs-example-modal-sm" id="verif_kursus<?=$kursus->id?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
						                                <div class="modal-dialog modal-sm">
						                                    <div class="modal-content">
						                                        <div class="modal-header" style="background-color:#008efa">
						                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						                                            <h4 class="modal-title" id="myLargeModalLabel" style="color:white">Alert !</h4>
						                                        </div>
						                                        <div class="modal-body">
																											Apakah anda yakin akan memverifikasi data ini ?
						                                        </div>
						                                        <div class="modal-footer">
																											<form method="post">
																												<input type="hidden" name="id_kursus" value="<?=$kursus->id?>">
																												<button type="submit" class="btn btn-danger waves-effect text-left" name="verif_kursus" >Verifikasi</button>
																											</form>
						                                            <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Batal</button>
						                                        </div>
						                                    </div>
						                                    <!-- /.modal-content -->
						                                </div>
						                                <!-- /.modal-dialog -->
						                            </div>
																				<!-- catat row -->
						                            <div class="modal fade bs-example-modal-md" id="catat_kursus<?=$kursus->id?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
						                                <div class="modal-dialog modal-md">
						                                    <div class="modal-content">
						                                        <div class="modal-header" style="background-color:#f0ad4e">
						                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						                                            <h4 class="modal-title" id="myLargeModalLabel" style="color:white">Alert !</h4>
						                                        </div>
																										<form method="post">
																											<input type="hidden" name="id_kursus" value="<?=$kursus->id?>">
						                                        <div class="modal-body">
																											Catatan :
																											<textarea name="catatan_verifikasi" class="form-control" rows="8" cols="80"></textarea>
						                                        </div>
						                                        <div class="modal-footer">
																												<button type="submit" class="btn btn-danger waves-effect text-left" name="catat_kursus" >Verifikasi</button>
						                                            <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Batal</button>
						                                        </div>
																										</form>
						                                    </div>
						                                    <!-- /.modal-content -->
						                                </div>
						                                <!-- /.modal-dialog -->
						                            </div>
																				<!-- sample modal content -->
																				<div class="modal fade bs-example-modal-sm" id="delete_kursus<?=$kursus->id?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
																					<div class="modal-dialog modal-sm">
																						<div class="modal-content">
																							<div class="modal-header" style="background-color:#f75b36">
																								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
																								<h4 class="modal-title" id="myLargeModalLabel" style="color:white">Alert !</h4>
																							</div>
																							<div class="modal-body">
																																		Apakah anda yakin akan menghapus data ini ?
																							</div>
																							<div class="modal-footer">
																																		<form method="post">
																																			<input type="hidden" name="id_kursus" value="<?=$kursus->id?>">
																																			<button type="submit" class="btn btn-danger waves-effect text-left" name="delete_kursus" >Hapus</button>
																																		</form>
																								<button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Batal</button>
																							</div>
																						</div>
																						<!-- /.modal-content -->
																					</div>
																					<!-- /.modal-dialog -->
																				</div>
																			<?php endforeach; ?>
																		</tbody>
																</table>
														</div>
														<hr>
											</div>
											<div id="form_riwayat_kursus">
												<button type="button" id="lihat_riwayat_kursus" class="btn btn-primary">Lihat Riwayat Kursus</button>
												<hr>
												<form method="post">
													<div class="form-group">
														<label for="">Jenis</label>
														<select class="form-control" name="id_kursus">
															<option value="">Pilih</option>
															<?php
															foreach($jeniskursus as $row)
															{
																echo "<option value='$row->id_kursus'>$row->nama_kursus</option>";
															}
															?>
														</select>
													</div>
													<div class="form-group">
														<label for="">Nama</label>
														<input type="text" class="form-control" name="nama_riwayat_kursus" value="">
													</div>
													<div class="form-group">
														<label for="">Tempat</label>
														<input type="text" class="form-control" name="tempat" value="">
													</div>
													<div class="form-group">
														<label for="">Penyelengara</label>
														<input type="text" class="form-control" name="penyelenggara" value="">
													</div>
													<div class="form-group">
														<label for="">Angkatan</label>
														<input type="number" class="form-control" name="angkatan" value="">
													</div>
													<div class="form-group">
														<label for="">Tgl. Mulai</label>
														<input type="date" class="form-control" name="tgl_mulai_kursus" value="">
													</div>
													<div class="form-group">
														<label for="">Tgl. Akhir</label>
														<input type="date" class="form-control" name="tgl_akhir_kursus" value="">
													</div>
													<div class="form-group">
														<label for="">No. SPTL</label>
														<input type="number" class="form-control" name="nomer_stpl" value="">
													</div>
													<div class="form-group">
														<label for="">Tgl. SPTL</label>
														<input type="date" class="form-control" name="tgl_stpl" value="">
													</div>
													<hr>
													<button type="submit" class="btn btn-primary" name="submit_kursus">Simpan</button>
												</form>
												<hr>
											</div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="unit_kerja1">
											<div id="table_riwayat_unit_kerja">
												<button type="button" id="tambah_riwayat_unit_kerja" class="btn btn-primary">Tambah Riwayat Unit Kerja</button>
												<hr>
												<div class="table-responsive">
																<table class="table color-table primary-table">
																		<thead>
																				<tr>
																						<th>#</th>
																						<th>Unit Kerja</th>
																						<th>TMT Awal</th>
																						<th>TMT Akhir</th>
																						<th>No. SK Awal</th>
																						<th>No. SK Akhir</th>
																						<th>Status</th>
																						<th>Aksi</th>
																				</tr>
																		</thead>
																		<tbody>
																			<?php foreach ($data_unit_kerja as $unit_kerja): ?>
																				<tr>
																						<td>1</td>
																						<td><?=isset($unit_kerja) ? $unit_kerja->nama_unit_kerja : "" ?></td>
																						<td><?=isset($unit_kerja) ? tanggal($unit_kerja->tmt_awal) : "" ?></td>
																						<td><?=isset($unit_kerja) ? tanggal($unit_kerja->tmt_akhir) : "" ?></td>
																						<td><?=isset($unit_kerja) ? $unit_kerja->no_sk_awal : "" ?></td>
																						<td><?=isset($unit_kerja) ? $unit_kerja->no_sk_akhir : "" ?></td>
																						<td>
																							<?php if ($unit_kerja->verifikasi_pegawai == "true" && $unit_kerja->verifikasi_bkd == "true"): ?>
																								<span class="label label-success">Sudah Diverifikasi</span>
																								<?php else: ?>
																								<span class="label label-danger">Belum Diverifikasi oleh Pegawai / BKD</span>
																							<?php endif; ?>
																						</td>
																						<td>
																							<?php if ($unit_kerja->verifikasi_bkd == false): ?>
																							<button type="submit" class="btn btn-info btn-sm btn-rounded" data-toggle="modal" data-target="#verif_unit_kerja<?=$unit_kerja->id?>"> <i class="ti-check"></i> </button>
																							<button type="submit" class="btn btn-warning btn-sm btn-rounded" data-toggle="modal" data-target="#catat_unit_kerja<?=$unit_kerja->id?>"> <i class="ti-pencil"></i> </button>
																							<?php endif; ?>
																							<button type="submit" class="btn btn-danger btn-sm btn-rounded" data-toggle="modal" data-target="#delete_unit_kerja<?=$unit_kerja->id?>"><i class="ti-trash"></i></button>
																						</td>
																				</tr>
																				<!-- verif row -->
						                            <div class="modal fade bs-example-modal-sm" id="verif_unit_kerja<?=$unit_kerja->id?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
						                                <div class="modal-dialog modal-sm">
						                                    <div class="modal-content">
						                                        <div class="modal-header" style="background-color:#008efa">
						                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						                                            <h4 class="modal-title" id="myLargeModalLabel" style="color:white">Alert !</h4>
						                                        </div>
						                                        <div class="modal-body">
																											Apakah anda yakin akan memverifikasi data ini ?
						                                        </div>
						                                        <div class="modal-footer">
																											<form method="post">
																												<input type="hidden" name="id_unit_kerja" value="<?=$unit_kerja->id?>">
																												<button type="submit" class="btn btn-danger waves-effect text-left" name="verif_unit_kerja" >Verifikasi</button>
																											</form>
						                                            <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Batal</button>
						                                        </div>
						                                    </div>
						                                    <!-- /.modal-content -->
						                                </div>
						                                <!-- /.modal-dialog -->
						                            </div>
																				<!-- catat row -->
						                            <div class="modal fade bs-example-modal-md" id="catat_unit_kerja<?=$unit_kerja->id?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
						                                <div class="modal-dialog modal-md">
						                                    <div class="modal-content">
						                                        <div class="modal-header" style="background-color:#f0ad4e">
						                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						                                            <h4 class="modal-title" id="myLargeModalLabel" style="color:white">Alert !</h4>
						                                        </div>
																										<form method="post">
																											<input type="hidden" name="id_unit_kerja" value="<?=$unit_kerja->id?>">
						                                        <div class="modal-body">
																											Catatan :
																											<textarea name="catatan_verifikasi" class="form-control" rows="8" cols="80"></textarea>
						                                        </div>
						                                        <div class="modal-footer">
																												<button type="submit" class="btn btn-danger waves-effect text-left" name="catat_unit_kerja" >Verifikasi</button>
						                                            <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Batal</button>
						                                        </div>
																										</form>
						                                    </div>
						                                    <!-- /.modal-content -->
						                                </div>
						                                <!-- /.modal-dialog -->
						                            </div>
																				<!-- sample modal content -->
																				<div class="modal fade bs-example-modal-sm" id="delete_unit_kerja<?=$unit_kerja->id?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
																					<div class="modal-dialog modal-sm">
																						<div class="modal-content">
																							<div class="modal-header" style="background-color:#f75b36">
																								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
																								<h4 class="modal-title" id="myLargeModalLabel" style="color:white">Alert !</h4>
																							</div>
																							<div class="modal-body">
																																		Apakah anda yakin akan menghapus data ini ?
																							</div>
																							<div class="modal-footer">
																																		<form method="post">
																																			<input type="hidden" name="id_unit_kerja" value="<?=$unit_kerja->id?>">
																																			<button type="submit" class="btn btn-danger waves-effect text-left" name="delete_unit_kerja" >Hapus</button>
																																		</form>
																								<button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Batal</button>
																							</div>
																						</div>
																						<!-- /.modal-content -->
																					</div>
																					<!-- /.modal-dialog -->
																				</div>
																			<?php endforeach; ?>
																		</tbody>
																</table>
														</div>
														<hr>
											</div>
											<div id="form_riwayat_unit_kerja">
												<button type="button" id="lihat_riwayat_unit_kerja" class="btn btn-primary">Lihat Riwayat Unit Kerja</button>
												<hr>
												<form method="post">
													<input type="hidden" name="nip" value="<?=$data_by_bkd->nip?>">
													<div class="form-group">
														<label for="">Unit Kerja</label>
														<select class="form-control" name="id_unit_kerja">
															<option value="">Pilih</option>
															<?php
															foreach($unit_kerja1 as $row)
															{
																echo "<option value='$row->id_unit_kerja'>$row->nama_unit_kerja</option>";
															}
															?>
														</select>
													</div>
													<div class="form-group">
														<label for="">TMT Awal</label>
														<input type="date" class="form-control" name="tmt_awal" value="">
													</div>
													<div class="form-group">
														<label for="">TMT Akhir</label>
														<input type="date" class="form-control" name="tmt_akhir" value="">
													</div>
													<div class="form-group">
														<label for="">No. SK Awal</label>
														<input type="number" class="form-control" name="no_sk_awal" value="">
													</div>
													<div class="form-group">
														<label for="">No. SK Akhir</label>
														<input type="number" class="form-control" name="no_sk_akhir" value="">
													</div>
												  <button type="submit" class="btn btn-primary" name="submit_unit_kerja">Simpan</button>
												</form>
											</div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="penghargaan1">
											<div id="table_riwayat_penghargaan">
												<button type="button" id="tambah_riwayat_penghargaan" class="btn btn-primary">Tambah Riwayat Penghargaan</button>
												<hr>
												<div class="table-responsive">
																<table class="table color-table primary-table">
																		<thead>
																				<tr>
																						<th>#</th>
																						<th>Jenis Penghargaan</th>
																						<th>Nama Penghargaan</th>
																						<th>Tahun</th>
																						<th>Asal Perolehan</th>
																						<th>Penandatangan</th>
																						<th>Nomor</th>
																						<th>Tanggal</th>
																						<th>Status</th>
																						<th>Aksi</th>
																				</tr>
																		</thead>
																		<tbody>
																			<?php foreach ($data_penghargaan as $penghargaan): ?>
																				<tr>
																						<td>1</td>
																						<td><?=isset($penghargaan) ? $penghargaan->nama_jenispenghargaan : "" ?></td>
																						<td><?=isset($penghargaan) ? $penghargaan->nama_penghargaan : "" ?></td>
																						<td><?=isset($penghargaan) ? $penghargaan->tahun : "" ?></td>
																						<td><?=isset($penghargaan) ? $penghargaan->asal_perolehan : "" ?></td>
																						<td><?=isset($penghargaan) ? $penghargaan->penandatangan : "" ?></td>
																						<td><?=isset($penghargaan) ? $penghargaan->no_penghargaan : "" ?></td>
																						<td><?=isset($penghargaan) ? tanggal($penghargaan->tgl_penghargaan) : "" ?></td>
																						<td>
																							<?php if ($penghargaan->verifikasi_pegawai == "true" && $penghargaan->verifikasi_bkd == "true"): ?>
																								<span class="label label-success">Sudah Diverifikasi</span>
																								<?php else: ?>
																								<span class="label label-danger">Belum Diverifikasi oleh Pegawai / BKD</span>
																							<?php endif; ?>
																						</td>
																						<td>
																							<?php if ($penghargaan->verifikasi_bkd == false): ?>
																							<button type="submit" class="btn btn-info btn-sm btn-rounded" data-toggle="modal" data-target="#verif_penghargaan<?=$penghargaan->id?>"> <i class="ti-check"></i> </button>
																							<button type="submit" class="btn btn-warning btn-sm btn-rounded" data-toggle="modal" data-target="#catat_penghargaan<?=$penghargaan->id?>"> <i class="ti-pencil"></i> </button>
																							<?php endif; ?>
																							<button type="submit" class="btn btn-danger btn-sm btn-rounded" data-toggle="modal" data-target="#delete_penghargaan<?=$penghargaan->id?>"><i class="ti-trash"></i></button>
																						</td>
																				</tr>
																				<!-- verif row -->
						                            <div class="modal fade bs-example-modal-sm" id="verif_penghargaan<?=$penghargaan->id?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
						                                <div class="modal-dialog modal-sm">
						                                    <div class="modal-content">
						                                        <div class="modal-header" style="background-color:#008efa">
						                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						                                            <h4 class="modal-title" id="myLargeModalLabel" style="color:white">Alert !</h4>
						                                        </div>
						                                        <div class="modal-body">
																											Apakah anda yakin akan memverifikasi data ini ?
						                                        </div>
						                                        <div class="modal-footer">
																											<form method="post">
																												<input type="hidden" name="id_penghargaan" value="<?=$penghargaan->id?>">
																												<button type="submit" class="btn btn-danger waves-effect text-left" name="verif_penghargaan" >Verifikasi</button>
																											</form>
						                                            <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Batal</button>
						                                        </div>
						                                    </div>
						                                    <!-- /.modal-content -->
						                                </div>
						                                <!-- /.modal-dialog -->
						                            </div>
																				<!-- catat row -->
						                            <div class="modal fade bs-example-modal-md" id="catat_penghargaan<?=$penghargaan->id?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
						                                <div class="modal-dialog modal-md">
						                                    <div class="modal-content">
						                                        <div class="modal-header" style="background-color:#f0ad4e">
						                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						                                            <h4 class="modal-title" id="myLargeModalLabel" style="color:white">Alert !</h4>
						                                        </div>
																										<form method="post">
																											<input type="hidden" name="id_penghargaan" value="<?=$penghargaan->id?>">
						                                        <div class="modal-body">
																											Catatan :
																											<textarea name="catatan_verifikasi" class="form-control" rows="8" cols="80"></textarea>
						                                        </div>
						                                        <div class="modal-footer">
																												<button type="submit" class="btn btn-danger waves-effect text-left" name="catat_penghargaan" >Verifikasi</button>
						                                            <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Batal</button>
						                                        </div>
																										</form>
						                                    </div>
						                                    <!-- /.modal-content -->
						                                </div>
						                                <!-- /.modal-dialog -->
						                            </div>
																				<!-- sample modal content -->
																				<div class="modal fade bs-example-modal-sm" id="delete_penghargaan<?=$penghargaan->id?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
																					<div class="modal-dialog modal-sm">
																						<div class="modal-content">
																							<div class="modal-header" style="background-color:#f75b36">
																								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
																								<h4 class="modal-title" id="myLargeModalLabel" style="color:white">Alert !</h4>
																							</div>
																							<div class="modal-body">
																																		Apakah anda yakin akan menghapus data ini ?
																							</div>
																							<div class="modal-footer">
																										<form method="post">
																											<input type="hidden" name="id_penghargaan" value="<?=$penghargaan->id?>">
																											<button type="submit" class="btn btn-danger waves-effect text-left" name="delete_penghargaan" >Hapus</button>
																										</form>
																								<button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Batal</button>
																							</div>
																						</div>
																						<!-- /.modal-content -->
																					</div>
																					<!-- /.modal-dialog -->
																				</div>
																			<?php endforeach; ?>
																		</tbody>
																</table>
														</div>
														<hr>
											</div>
											<div id="form_riwayat_penghargaan">
												<button type="button" id="lihat_riwayat_penghargaan" class="btn btn-primary">Lihat Riwayat Penghargaan</button>
												<hr>
												<form method="post">
													<input type="hidden" name="nip" value="<?=$data_by_bkd->nip?>">
													<div class="form-group">
														<label for="">Jenis Penghargaan</label>
														<select class="form-control" name="id_jenispenghargaan">
															<option value="">Pilih</option>
															<?php
														  foreach ($jenispenghargaan as $row){
					                                       echo "<option value='$row->id_jenispenghargaan'>$row->nama_jenispenghargaan</option>";
														  }?>
														</select>
													</div>
													<div class="form-group">
														<label for="">Nama Penghargaan</label>
														<input type="text" class="form-control" name="nama_penghargaan" value="">
													</div>
													<div class="form-group">
														<label for="">Tahun</label>
														<input type="number" class="form-control" name="tahun" value="">
													</div>
													<div class="form-group">
														<label for="">Asal Perolehan</label>
														<input type="text" class="form-control" name="asal_perolehan" value="">
													</div>
													<div class="form-group">
														<label for="">Penandatangan</label>
														<input type="text" class="form-control" name="penandatangan" value="">
													</div>
													<div class="form-group">
														<label for="">Nomor Penghargaan</label>
														<input type="number" class="form-control" name="no_penghargaan" value="">
													</div>
													<div class="form-group">
														<label for="">Tanggal</label>
														<input type="date" class="form-control" name="tgl_penghargaan" value="">
													</div>
													<button type="submit" class="btn btn-primary" name="submit_penghargaan">Simpan</button>
												</form>
											</div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="absen1">
											<div id="table_riwayat_penugasan">
												<button type="button" id="tambah_riwayat_penugasan" class="btn btn-primary">Tambah Riwayat Penugasan ke Luar Negeri</button>
												<hr>
												<div class="table-responsive">
																<table class="table color-table primary-table">
																		<thead>
																				<tr>
																						<th>#</th>
																						<th>Jenis Penugasan</th>
																						<th>Tempat</th>
																						<th>Pejabat Penetapan</th>
																						<th>Nomor SK</th>
																						<th>Tanggal SK</th>
																						<th>Tgl. Awal Penugasan</th>
																						<th>Tgl. Akhir Penugasan</th>
																						<th>Status</th>
																						<th>Aksi</th>
																				</tr>
																		</thead>
																		<tbody>
																			<?php foreach ($data_penugasan as $penugasan): ?>
																				<tr>
																						<td>1</td>
																						<td><?=isset($penugasan) ? $penugasan->nama_jenispenugasan : "" ?></td>
																						<td><?=isset($penugasan) ? $penugasan->tempat : "" ?></td>
																						<td><?=isset($penugasan) ? $penugasan->pejabat_penetap : "" ?></td>
																						<td><?=isset($penugasan) ? $penugasan->nomer_sk : "" ?></td>
																						<td><?=isset($penugasan) ? tanggal($penugasan->tgl_sk) : "" ?></td>
																						<td><?=isset($penugasan) ? tanggal($penugasan->tgl_mulai_penugasan) : "" ?></td>
																						<td><?=isset($penugasan) ? tanggal($penugasan->tgl_akhir_penugasan) : "" ?></td>
																						<td>
																							<?php if ($penugasan->verifikasi_pegawai == "true" && $penugasan->verifikasi_bkd == "true"): ?>
																								<span class="label label-success">Sudah Diverifikasi</span>
																								<?php else: ?>
																								<span class="label label-danger">Belum Diverifikasi oleh Pegawai / BKD</span>
																							<?php endif; ?>
																						</td>
																						<td>
																							<?php if ($penugasan->verifikasi_bkd == false): ?>
																							<button type="submit" class="btn btn-info btn-sm btn-rounded" data-toggle="modal" data-target="#verif_penugasan<?=$penugasan->id?>"> <i class="ti-check"></i> </button>
																							<button type="submit" class="btn btn-warning btn-sm btn-rounded" data-toggle="modal" data-target="#catat_penugasan<?=$penugasan->id?>"> <i class="ti-pencil"></i> </button>
																							<?php endif; ?>
																							<button type="submit" class="btn btn-danger btn-sm btn-rounded" data-toggle="modal" data-target="#delete_penugasan<?=$penugasan->id?>"><i class="ti-trash"></i></button>
																						</td>
																				</tr>
																				<!-- verif row -->
						                            <div class="modal fade bs-example-modal-sm" id="verif_penugasan<?=$penugasan->id?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
						                                <div class="modal-dialog modal-sm">
						                                    <div class="modal-content">
						                                        <div class="modal-header" style="background-color:#008efa">
						                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						                                            <h4 class="modal-title" id="myLargeModalLabel" style="color:white">Alert !</h4>
						                                        </div>
						                                        <div class="modal-body">
																											Apakah anda yakin akan memverifikasi data ini ?
						                                        </div>
						                                        <div class="modal-footer">
																											<form method="post">
																												<input type="hidden" name="id_penugasan" value="<?=$penugasan->id?>">
																												<button type="submit" class="btn btn-danger waves-effect text-left" name="verif_penugasan" >Verifikasi</button>
																											</form>
						                                            <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Batal</button>
						                                        </div>
						                                    </div>
						                                    <!-- /.modal-content -->
						                                </div>
						                                <!-- /.modal-dialog -->
						                            </div>
																				<!-- catat row -->
						                            <div class="modal fade bs-example-modal-md" id="catat_penugasan<?=$penugasan->id?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
						                                <div class="modal-dialog modal-md">
						                                    <div class="modal-content">
						                                        <div class="modal-header" style="background-color:#f0ad4e">
						                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						                                            <h4 class="modal-title" id="myLargeModalLabel" style="color:white">Alert !</h4>
						                                        </div>
																										<form method="post">
																											<input type="hidden" name="id_penugasan" value="<?=$penugasan->id?>">
						                                        <div class="modal-body">
																											Catatan :
																											<textarea name="catatan_verifikasi" class="form-control" rows="8" cols="80"></textarea>
						                                        </div>
						                                        <div class="modal-footer">
																												<button type="submit" class="btn btn-danger waves-effect text-left" name="catat_penugasan" >Verifikasi</button>
						                                            <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Batal</button>
						                                        </div>
																										</form>
						                                    </div>
						                                    <!-- /.modal-content -->
						                                </div>
						                                <!-- /.modal-dialog -->
						                            </div>
																				<!-- sample modal content -->
																				<div class="modal fade bs-example-modal-sm" id="delete_penugasan<?=$penugasan->id?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
																					<div class="modal-dialog modal-sm">
																						<div class="modal-content">
																							<div class="modal-header" style="background-color:#f75b36">
																								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
																								<h4 class="modal-title" id="myLargeModalLabel" style="color:white">Alert !</h4>
																							</div>
																							<div class="modal-body">
																																		Apakah anda yakin akan menghapus data ini ?
																							</div>
																							<div class="modal-footer">
																																		<form method="post">
																																			<input type="hidden" name="id_penugasan" value="<?=$penugasan->id?>">
																																			<button type="submit" class="btn btn-danger waves-effect text-left" name="delete_penugasan" >Hapus</button>
																																		</form>
																								<button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Batal</button>
																							</div>
																						</div>
																						<!-- /.modal-content -->
																					</div>
																					<!-- /.modal-dialog -->
																				</div>
																			<?php endforeach; ?>
																		</tbody>
																</table>
														</div>
														<hr>
											</div>
											<div id="form_riwayat_penugasan">
												<button type="button" id="lihat_riwayat_penugasan" class="btn btn-primary">Lihat Riwayat Penugasan ke Luar Negeri</button>
												<hr>
												<form method="post">
													<input type="hidden" name="nip" value="<?=$data_by_bkd->nip?>">
													<div class="form-group">
														<label for="">Jenis Penugasan</label>
														<select class="form-control" name="id_jenispenugasan">
															<option value="">Pilih</option>
															<?php
															foreach ($jenispenugasan as $row){
																	echo "<option value='$row->id_jenispenugasan'>$row->nama_jenispenugasan</option>";
															}?>
														</select>
													</div>
													<div class="form-group">
														<label for="">Negara/Kota Tujuan</label>
														<input type="text" class="form-control" name="tempat" value="">
													</div>
													<div class="form-group">
														<label for="">Pejabat yang menetapkan</label>
														<input type="text" class="form-control" name="pejabat_penetap" value="">
													</div>
													<div class="form-group">
														<label for="">No. SK</label>
														<input type="number" class="form-control" name="nomer_sk" value="">
													</div>
													<div class="form-group">
														<label for="">Tgl. SK</label>
														<input type="date" class="form-control" name="tgl_sk" value="">
													</div>
													<div class="form-group">
														<label for="">Tgl. Mulai Penugasan</label>
														<input type="date" class="form-control" name="tgl_mulai_penugasan" value="">
													</div>
													<div class="form-group">
														<label for="">Tgl. Akhir Penugasan</label>
														<input type="date" class="form-control" name="tgl_akhir_penugasan" value="">
													</div>
													<hr>
													<button type="submit" class="btn btn-primary" name="submit_penugasan">Simpan</button>
													<hr>
												</form>
											</div>
											<div id="table_riwayat_cuti">
												<button type="button" id="tambah_riwayat_cuti" class="btn btn-primary">Tambah Riwayat Cuti</button>
												<hr>
												<div class="table-responsive">
																<table class="table color-table primary-table">
																		<thead>
																				<tr>
																						<th>#</th>
																						<th>Jenis Cuti</th>
																						<th>Keterangan</th>
																						<th>Pejabat Penetapan</th>
																						<th>Nomor SK</th>
																						<th>Tanggal SK</th>
																						<th>Tgl. Awal Cuti</th>
																						<th>Tgl. Akhir Cuti</th>
																						<th>Status</th>
																						<th>Aksi</th>
																				</tr>
																		</thead>
																		<tbody>
																			<?php foreach ($data_cuti as $cuti): ?>
																				<tr>
																						<td>1</td>
																						<td><?=isset($cuti) ? $cuti->nama_jeniscuti : "" ?></td>
																						<td><?=isset($cuti) ? $cuti->keterangan : "" ?></td>
																						<td><?=isset($cuti) ? $cuti->pejabat_penetapan : "" ?></td>
																						<td><?=isset($cuti) ? $cuti->no_sk : "" ?></td>
																						<td><?=isset($cuti) ? tanggal($cuti->tgl_sk) : "" ?></td>
																						<td><?=isset($cuti) ? tanggal($cuti->tgl_awal_cuti) : "" ?></td>
																						<td><?=isset($cuti) ? tanggal($cuti->tgl_akhir_cuti) : "" ?></td>
																						<td>
																							<?php if ($cuti->verifikasi_pegawai == "true" && $cuti->verifikasi_bkd == "true"): ?>
																								<span class="label label-success">Sudah Diverifikasi</span>
																								<?php else: ?>
																								<span class="label label-danger">Belum Diverifikasi oleh Pegawai / BKD</span>
																							<?php endif; ?>
																						</td>
																						<td>
																							<?php if ($cuti->verifikasi_bkd == false): ?>
																							<button type="submit" class="btn btn-info btn-sm btn-rounded" data-toggle="modal" data-target="#verif_cuti<?=$cuti->id?>"> <i class="ti-check"></i> </button>
																							<button type="submit" class="btn btn-warning btn-sm btn-rounded" data-toggle="modal" data-target="#catat_cuti<?=$cuti->id?>"> <i class="ti-pencil"></i> </button>
																							<?php endif; ?>
																							<button type="submit" class="btn btn-danger btn-sm btn-rounded" data-toggle="modal" data-target="#delete_cuti<?=$cuti->id?>"><i class="ti-trash"></i></button>
																						</td>
																				</tr>
																				<!-- verif row -->
						                            <div class="modal fade bs-example-modal-sm" id="verif_cuti<?=$cuti->id?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
						                                <div class="modal-dialog modal-sm">
						                                    <div class="modal-content">
						                                        <div class="modal-header" style="background-color:#008efa">
						                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						                                            <h4 class="modal-title" id="myLargeModalLabel" style="color:white">Alert !</h4>
						                                        </div>
						                                        <div class="modal-body">
																											Apakah anda yakin akan memverifikasi data ini ?
						                                        </div>
						                                        <div class="modal-footer">
																											<form method="post">
																												<input type="hidden" name="id_cuti" value="<?=$cuti->id?>">
																												<button type="submit" class="btn btn-danger waves-effect text-left" name="verif_cuti" >Verifikasi</button>
																											</form>
						                                            <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Batal</button>
						                                        </div>
						                                    </div>
						                                    <!-- /.modal-content -->
						                                </div>
						                                <!-- /.modal-dialog -->
						                            </div>
																				<!-- catat row -->
						                            <div class="modal fade bs-example-modal-md" id="catat_cuti<?=$cuti->id?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
						                                <div class="modal-dialog modal-md">
						                                    <div class="modal-content">
						                                        <div class="modal-header" style="background-color:#f0ad4e">
						                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						                                            <h4 class="modal-title" id="myLargeModalLabel" style="color:white">Alert !</h4>
						                                        </div>
																										<form method="post">
																											<input type="hidden" name="id_cuti" value="<?=$cuti->id?>">
						                                        <div class="modal-body">
																											Catatan :
																											<textarea name="catatan_verifikasi" class="form-control" rows="8" cols="80"></textarea>
						                                        </div>
						                                        <div class="modal-footer">
																												<button type="submit" class="btn btn-danger waves-effect text-left" name="catat_cuti" >Verifikasi</button>
						                                            <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Batal</button>
						                                        </div>
																										</form>
						                                    </div>
						                                    <!-- /.modal-content -->
						                                </div>
						                                <!-- /.modal-dialog -->
						                            </div>
																				<!-- sample modal content -->
																				<div class="modal fade bs-example-modal-sm" id="delete_cuti<?=$cuti->id?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
																					<div class="modal-dialog modal-sm">
																						<div class="modal-content">
																							<div class="modal-header" style="background-color:#f75b36">
																								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
																								<h4 class="modal-title" id="myLargeModalLabel" style="color:white">Alert !</h4>
																							</div>
																							<div class="modal-body">
																																		Apakah anda yakin akan menghapus data ini ?
																							</div>
																							<div class="modal-footer">
																									<form method="post">
																										<input type="hidden" name="id_cuti" value="<?=$cuti->id?>">
																										<button type="submit" class="btn btn-danger waves-effect text-left" name="delete_cuti" >Hapus</button>
																									</form>
																								<button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Batal</button>
																							</div>
																						</div>
																						<!-- /.modal-content -->
																					</div>
																					<!-- /.modal-dialog -->
																				</div>
																			<?php endforeach; ?>
																		</tbody>
																</table>
														</div>
														<hr>
											</div>
											<div id="form_riwayat_cuti">
												<button type="button" id="lihat_riwayat_cuti" class="btn btn-primary">Lihat Riwayat Cuti</button>
												<hr>
												<form method="post">
													<input type="hidden" name="nip" value="<?=$data_by_bkd->nip?>">
													<div class="form-group">
														<label for="">Jenis Cuti</label>
														<select class="form-control" name="id_jeniscuti">
															<option value="">Pilih</option>
															<?php
															foreach ($jeniscuti as $row){
																		echo "<option value='$row->id_jeniscuti'>$row->nama_jeniscuti</option>";
															}?>
														</select>
													</div>
													<div class="form-group">
														<label for="">Keterangan</label>
														<input type="text" class="form-control" name="keterangan" value="">
													</div>
													<div class="form-group">
														<label for="">Pejabat yang menetapkan</label>
														<input type="text" class="form-control" name="pejabat_penetapan" value="">
													</div>
													<div class="form-group">
														<label for="">No. SK</label>
														<input type="number" class="form-control" name="no_sk" value="">
													</div>
													<div class="form-group">
														<label for="">Tgl. SK</label>
														<input type="date" class="form-control" name="tgl_sk" value="">
													</div>
													<div class="form-group">
														<label for="">Tgl. Awal Cuti</label>
														<input type="date" class="form-control" name="tgl_awal_cuti" value="">
													</div>
													<div class="form-group">
														<label for="">Tgl. Akhir Cuti</label>
														<input type="date" class="form-control" name="tgl_akhir_cuti" value="">
													</div>
													<hr>
													<button type="submit" class="btn btn-primary" name="submit_cuti">Simpan</button>
													<hr>
												</form>
											</div>
											<div id="table_riwayat_hukuman">
												<button type="button" id="tambah_riwayat_hukuman" class="btn btn-primary">Tambah Riwayat Hukuman Disiplin</button>
												<hr>
												<div class="table-responsive">
																<table class="table color-table primary-table">
																		<thead>
																				<tr>
																						<th>#</th>
																						<th>Jenis Hukuman</th>
																						<th>Keterangan</th>
																						<th>Pejabat Penetapan</th>
																						<th>Nomor SK</th>
																						<th>Tanggal SK</th>
																						<th>Tgl. Awal Hukuman</th>
																						<th>Tgl. Akhir Hukuman</th>
																						<th>Status</th>
																						<th>Aksi</th>
																				</tr>
																		</thead>
																		<tbody>
																			<?php foreach ($data_hukuman as $hukuman): ?>
																				<tr>
																						<td>1</td>
																						<td><?=isset($hukuman) ? $hukuman->nama_jenishukuman : "" ?></td>
																						<td><?=isset($hukuman) ? $hukuman->keterangan : "" ?></td>
																						<td><?=isset($hukuman) ? $hukuman->pejabat_penetap : "" ?></td>
																						<td><?=isset($hukuman) ? $hukuman->nomer_sk : "" ?></td>
																						<td><?=isset($hukuman) ? tanggal($hukuman->tgl_sk) : "" ?></td>
																						<td><?=isset($hukuman) ? tanggal($hukuman->tgl_mulai_hukuman) : "" ?></td>
																						<td><?=isset($hukuman) ? tanggal($hukuman->tgl_akhir_hukuman) : "" ?></td>
																						<td>
																							<?php if ($hukuman->verifikasi_pegawai == "true" && $hukuman->verifikasi_bkd == "true"): ?>
																								<span class="label label-success">Sudah Diverifikasi</span>
																								<?php else: ?>
																								<span class="label label-danger">Belum Diverifikasi oleh Pegawai / BKD</span>
																							<?php endif; ?>
																						</td>
																						<td>
																							<?php if ($hukuman->verifikasi_bkd == false): ?>
																							<button type="submit" class="btn btn-info btn-sm btn-rounded" data-toggle="modal" data-target="#verif_hukuman<?=$hukuman->id?>"> <i class="ti-check"></i> </button>
																							<button type="submit" class="btn btn-warning btn-sm btn-rounded" data-toggle="modal" data-target="#catat_hukuman<?=$hukuman->id?>"> <i class="ti-pencil"></i> </button>
																							<?php endif; ?>
																							<button type="submit" class="btn btn-danger btn-sm btn-rounded" data-toggle="modal" data-target="#delete_hukuman<?=$hukuman->id?>"><i class="ti-trash"></i></button>
																						</td>
																				</tr>
																				<!-- verif row -->
						                            <div class="modal fade bs-example-modal-sm" id="verif_hukuman<?=$hukuman->id?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
						                                <div class="modal-dialog modal-sm">
						                                    <div class="modal-content">
						                                        <div class="modal-header" style="background-color:#008efa">
						                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						                                            <h4 class="modal-title" id="myLargeModalLabel" style="color:white">Alert !</h4>
						                                        </div>
						                                        <div class="modal-body">
																											Apakah anda yakin akan memverifikasi data ini ?
						                                        </div>
						                                        <div class="modal-footer">
																											<form method="post">
																												<input type="hidden" name="id_hukuman" value="<?=$hukuman->id?>">
																												<button type="submit" class="btn btn-danger waves-effect text-left" name="verif_hukuman" >Verifikasi</button>
																											</form>
						                                            <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Batal</button>
						                                        </div>
						                                    </div>
						                                    <!-- /.modal-content -->
						                                </div>
						                                <!-- /.modal-dialog -->
						                            </div>
																				<!-- catat row -->
						                            <div class="modal fade bs-example-modal-md" id="catat_hukuman<?=$hukuman->id?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
						                                <div class="modal-dialog modal-md">
						                                    <div class="modal-content">
						                                        <div class="modal-header" style="background-color:#f0ad4e">
						                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						                                            <h4 class="modal-title" id="myLargeModalLabel" style="color:white">Alert !</h4>
						                                        </div>
																										<form method="post">
																											<input type="hidden" name="id_hukuman" value="<?=$hukuman->id?>">
						                                        <div class="modal-body">
																											Catatan :
																											<textarea name="catatan_verifikasi" class="form-control" rows="8" cols="80"></textarea>
						                                        </div>
						                                        <div class="modal-footer">
																												<button type="submit" class="btn btn-danger waves-effect text-left" name="catat_hukuman" >Verifikasi</button>
						                                            <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Batal</button>
						                                        </div>
																										</form>
						                                    </div>
						                                    <!-- /.modal-content -->
						                                </div>
						                                <!-- /.modal-dialog -->
						                            </div>
																				<!-- sample modal content -->
																				<div class="modal fade bs-example-modal-sm" id="delete_hukuman<?=$hukuman->id?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
																					<div class="modal-dialog modal-sm">
																						<div class="modal-content">
																							<div class="modal-header" style="background-color:#f75b36">
																								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
																								<h4 class="modal-title" id="myLargeModalLabel" style="color:white">Alert !</h4>
																							</div>
																							<div class="modal-body">
																																		Apakah anda yakin akan menghapus data ini ?
																							</div>
																							<div class="modal-footer">
																																		<form method="post">
																																			<input type="hidden" name="id_hukuman" value="<?=$hukuman->id?>">
																																			<button type="submit" class="btn btn-danger waves-effect text-left" name="delete_hukuman" >Hapus</button>
																																		</form>
																								<button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Batal</button>
																							</div>
																						</div>
																						<!-- /.modal-content -->
																					</div>
																					<!-- /.modal-dialog -->
																				</div>
																			<?php endforeach; ?>
																		</tbody>
																</table>
														</div>
														<hr>
											</div>
											<div id="form_riwayat_hukuman">
												<button type="button" id="lihat_riwayat_hukuman" class="btn btn-primary">Lihat Riwayat Hukuman Disiplin</button>
												<hr>
												<form method="post">
													<input type="hidden" name="nip" value="<?=$data_by_bkd->nip?>">
													<div class="form-group">
														<label for="">Jenis Hukuman</label>
														<select class="form-control" name="id_jenishukuman">
															<option value="">Pilih</option>
															<?php
															foreach ($jenishukuman as $row){
																	echo "<option value='$row->id_jenishukuman'>$row->nama_jenishukuman</option>";
															}?>
														</select>
													</div>
													<div class="form-group">
														<label for="">Keterangan</label>
														<input type="text" class="form-control" name="keterangan" value="">
													</div>
													<div class="form-group">
														<label for="">Pejabat yang menetapkan</label>
														<input type="text" class="form-control" name="pejabat_penetap" value="">
													</div>
													<div class="form-group">
														<label for="">No. SK</label>
														<input type="number" class="form-control" name="nomer_sk" value="">
													</div>
													<div class="form-group">
														<label for="">Tgl. SK</label>
														<input type="date" class="form-control" name="tgl_sk" value="">
													</div>
													<div class="form-group">
														<label for="">Tgl. Awal Cuti</label>
														<input type="date" class="form-control" name="tgl_mulai_hukuman" value="">
													</div>
													<div class="form-group">
														<label for="">Tgl. Akhir Cuti</label>
														<input type="date" class="form-control" name="tgl_akhir_hukuman" value="">
													</div>
													<hr>
													<button type="submit" class="btn btn-primary" name="submit_hukuman">Simpan</button>
													<hr>
												</form>
											</div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="bahasa1">
											<div id="table_riwayat_bahasa">
												<button type="button" id="tambah_riwayat_bahasa" class="btn btn-primary">Tambah Riwayat Bahasa</button>
												<hr>
												<div class="table-responsive">
																<table class="table color-table primary-table">
																		<thead>
																				<tr>
																						<th>#</th>
																						<th>Nama Bahasa</th>
																						<th>Kemampuan Bahasa</th>
																						<th>Status</th>
																						<th>Aksi</th>
																				</tr>
																		</thead>
																		<tbody>
																			<?php foreach ($data_bahasa as $bahasa): ?>
																				<tr>
																						<td>1</td>
																						<td><?=isset($bahasa) ? $bahasa->nama_bahasa : "" ?></td>
																						<td><?=isset($bahasa) ? $bahasa->kemampuan : "" ?></td>
																						<td>
																							<?php if ($bahasa->verifikasi_pegawai == "true" && $bahasa->verifikasi_bkd == "true"): ?>
																								<span class="label label-success">Sudah Diverifikasi</span>
																								<?php else: ?>
																								<span class="label label-danger">Belum Diverifikasi oleh Pegawai / BKD</span>
																							<?php endif; ?>
																						</td>
																						<td>
																							<?php if ($bahasa->verifikasi_bkd == false): ?>
																							<button type="submit" class="btn btn-info btn-sm btn-rounded" data-toggle="modal" data-target="#verif_bahasa<?=$bahasa->id?>"> <i class="ti-check"></i> </button>
																							<button type="submit" class="btn btn-warning btn-sm btn-rounded" data-toggle="modal" data-target="#catat_bahasa<?=$bahasa->id?>"> <i class="ti-pencil"></i> </button>
																							<?php endif; ?>
																							<button type="submit" class="btn btn-danger btn-sm btn-rounded" data-toggle="modal" data-target="#delete_bahasa<?=$bahasa->id?>"><i class="ti-trash"></i></button>
																						</td>
																				</tr>
																				<!-- verif row -->
						                            <div class="modal fade bs-example-modal-sm" id="verif_bahasa<?=$bahasa->id?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
						                                <div class="modal-dialog modal-sm">
						                                    <div class="modal-content">
						                                        <div class="modal-header" style="background-color:#008efa">
						                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						                                            <h4 class="modal-title" id="myLargeModalLabel" style="color:white">Alert !</h4>
						                                        </div>
						                                        <div class="modal-body">
																											Apakah anda yakin akan memverifikasi data ini ?
						                                        </div>
						                                        <div class="modal-footer">
																											<form method="post">
																												<input type="hidden" name="id_bahasa" value="<?=$bahasa->id?>">
																												<button type="submit" class="btn btn-danger waves-effect text-left" name="verif_bahasa" >Verifikasi</button>
																											</form>
						                                            <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Batal</button>
						                                        </div>
						                                    </div>
						                                    <!-- /.modal-content -->
						                                </div>
						                                <!-- /.modal-dialog -->
						                            </div>
																				<!-- catat row -->
						                            <div class="modal fade bs-example-modal-md" id="catat_bahasa<?=$bahasa->id?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
						                                <div class="modal-dialog modal-md">
						                                    <div class="modal-content">
						                                        <div class="modal-header" style="background-color:#f0ad4e">
						                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						                                            <h4 class="modal-title" id="myLargeModalLabel" style="color:white">Alert !</h4>
						                                        </div>
																										<form method="post">
																											<input type="hidden" name="id_bahasa" value="<?=$bahasa->id?>">
						                                        <div class="modal-body">
																											Catatan :
																											<textarea name="catatan_verifikasi" class="form-control" rows="8" cols="80"></textarea>
						                                        </div>
						                                        <div class="modal-footer">
																												<button type="submit" class="btn btn-danger waves-effect text-left" name="catat_bahasa" >Verifikasi</button>
						                                            <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Batal</button>
						                                        </div>
																										</form>
						                                    </div>
						                                    <!-- /.modal-content -->
						                                </div>
						                                <!-- /.modal-dialog -->
						                            </div>
																				<!-- sample modal content -->
																				<div class="modal fade bs-example-modal-sm" id="delete_bahasa<?=$bahasa->id?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
																					<div class="modal-dialog modal-sm">
																						<div class="modal-content">
																							<div class="modal-header" style="background-color:#f75b36">
																								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
																								<h4 class="modal-title" id="myLargeModalLabel" style="color:white">Alert !</h4>
																							</div>
																							<div class="modal-body">
																																		Apakah anda yakin akan menghapus data ini ?
																							</div>
																							<div class="modal-footer">
																									<form method="post">
																										<input type="hidden" name="id_bahasa" value="<?=$bahasa->id?>">
																										<button type="submit" class="btn btn-danger waves-effect text-left" name="delete_bahasa" >Hapus</button>
																									</form>
																								<button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Batal</button>
																							</div>
																						</div>
																						<!-- /.modal-content -->
																					</div>
																					<!-- /.modal-dialog -->
																				</div>
																			<?php endforeach; ?>
																		</tbody>
																</table>
														</div>
											</div>
											<div id="form_riwayat_bahasa">
												<button type="button" id="lihat_riwayat_bahasa" class="btn btn-primary">Lihat Riwayat Bahasa</button>
												<hr>
												<form method="post">
													<input type="hidden" name="nip" value="<?=$data_by_bkd->nip?>">
													<div class="form-group">
														<label for="">Nama Bahasa</label>
														<select class="form-control" name="id_bahasa">
															<option value="">Pilih</option>
															<?php
															foreach ($jenisbahasa as $row){
																		echo "<option value='$row->id_bahasa'>$row->nama_bahasa</option>";
															}?>
														</select>
													</div>
													<div class="form-group">
														<label for="">Kemampuan Bahasa</label>
														<select class="form-control" name="kemampuan">
															<option value="">Pilih</option>
															<option value='Aktif'>Aktif</option>
															<option value='Pasif'>Pasif</option>
														</select>
													</div>
													<hr>
													<button type="submit" class="btn btn-primary" name="submit_bahasa">Simpan</button>
												</form>
											</div>
													<hr>
											<div id="table_riwayat_bahasa_asing">
												<button type="button" id="tambah_riwayat_bahasa_asing" class="btn btn-primary">Tambah Riwayat Bahasa Asing</button>
												<hr>
												<div class="table-responsive">
																<table class="table color-table primary-table">
																		<thead>
																				<tr>
																						<th>#</th>
																						<th>Nama Bahasa</th>
																						<th>Kemampuan Bahasa</th>
																						<th>Status</th>
																						<th>Aksi</th>
																				</tr>
																		</thead>
																		<tbody>
																			<?php foreach ($data_bahasa_asing as $bahasa_asing): ?>
																				<tr>
																						<td>1</td>
																						<td><?=isset($bahasa_asing) ? $bahasa_asing->nama_bahasa_asing : "" ?></td>
																						<td><?=isset($bahasa_asing) ? $bahasa_asing->kemampuan : "" ?></td>
																						<td>
																							<?php if ($bahasa_asing->verifikasi_pegawai == "true" && $bahasa_asing->verifikasi_bkd == "true"): ?>
																								<span class="label label-success">Sudah Diverifikasi</span>
																								<?php else: ?>
																								<span class="label label-danger">Belum Diverifikasi oleh Pegawai / BKD</span>
																							<?php endif; ?>
																						</td>
																						<td>
																							<?php if ($bahasa_asing->verifikasi_bkd == false): ?>
																							<button type="submit" class="btn btn-info btn-sm btn-rounded" data-toggle="modal" data-target="#verif_bahasa_asing<?=$bahasa_asing->id?>"> <i class="ti-check"></i> </button>
																							<button type="submit" class="btn btn-warning btn-sm btn-rounded" data-toggle="modal" data-target="#catat_bahasa_asing<?=$bahasa_asing->id?>"> <i class="ti-pencil"></i> </button>
																							<?php endif; ?>
																							<button type="submit" class="btn btn-danger btn-sm btn-rounded" data-toggle="modal" data-target="#delete_bahasa_asing<?=$bahasa_asing->id?>"><i class="ti-trash"></i></button>
																						</td>
																				</tr>
																				<!-- verif row -->
						                            <div class="modal fade bs-example-modal-sm" id="verif_bahasa_asing<?=$bahasa_asing->id?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
						                                <div class="modal-dialog modal-sm">
						                                    <div class="modal-content">
						                                        <div class="modal-header" style="background-color:#008efa">
						                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						                                            <h4 class="modal-title" id="myLargeModalLabel" style="color:white">Alert !</h4>
						                                        </div>
						                                        <div class="modal-body">
																											Apakah anda yakin akan memverifikasi data ini ?
						                                        </div>
						                                        <div class="modal-footer">
																											<form method="post">
																												<input type="hidden" name="id_bahasa_asing" value="<?=$bahasa_asing->id?>">
																												<button type="submit" class="btn btn-danger waves-effect text-left" name="verif_bahasa_asing" >Verifikasi</button>
																											</form>
						                                            <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Batal</button>
						                                        </div>
						                                    </div>
						                                    <!-- /.modal-content -->
						                                </div>
						                                <!-- /.modal-dialog -->
						                            </div>
																				<!-- catat row -->
						                            <div class="modal fade bs-example-modal-md" id="catat_bahasa_asing<?=$bahasa_asing->id?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
						                                <div class="modal-dialog modal-md">
						                                    <div class="modal-content">
						                                        <div class="modal-header" style="background-color:#f0ad4e">
						                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						                                            <h4 class="modal-title" id="myLargeModalLabel" style="color:white">Alert !</h4>
						                                        </div>
																										<form method="post">
																											<input type="hidden" name="id_bahasa_asing" value="<?=$bahasa_asing->id?>">
						                                        <div class="modal-body">
																											Catatan :
																											<textarea name="catatan_verifikasi" class="form-control" rows="8" cols="80"></textarea>
						                                        </div>
						                                        <div class="modal-footer">
																												<button type="submit" class="btn btn-danger waves-effect text-left" name="catat_bahasa_asing" >Verifikasi</button>
						                                            <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Batal</button>
						                                        </div>
																										</form>
						                                    </div>
						                                    <!-- /.modal-content -->
						                                </div>
						                                <!-- /.modal-dialog -->
						                            </div>
																				<!-- sample modal content -->
																				<div class="modal fade bs-example-modal-sm" id="delete_bahasa_asing<?=$bahasa_asing->id?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
																					<div class="modal-dialog modal-sm">
																						<div class="modal-content">
																							<div class="modal-header" style="background-color:#f75b36">
																								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
																								<h4 class="modal-title" id="myLargeModalLabel" style="color:white">Alert !</h4>
																							</div>
																							<div class="modal-body">
																																		Apakah anda yakin akan menghapus data ini ?
																							</div>
																							<div class="modal-footer">
																									<form method="post">
																										<input type="hidden" name="id_bahasa_asing" value="<?=$bahasa_asing->id?>">
																										<button type="submit" class="btn btn-danger waves-effect text-left" name="delete_bahasa_asing" >Hapus</button>
																									</form>
																								<button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Batal</button>
																							</div>
																						</div>
																						<!-- /.modal-content -->
																					</div>
																					<!-- /.modal-dialog -->
																				</div>
																			<?php endforeach; ?>
																		</tbody>
																</table>
														</div>
														<hr>
											</div>
											<div id="form_riwayat_bahasa_asing">
												<button type="button" id="lihat_riwayat_bahasa_asing" class="btn btn-primary">Lihat Riwayat Bahasa Asing</button>
												<hr>
												<form method="post">
													<input type="hidden" name="nip" value="<?=$data_by_bkd->nip?>">
													<div class="form-group">
														<label for="">Nama Bahasa</label>
														<select class="form-control" name="id_bahasa_asing">
															<option value="">Pilih</option>
															<?php
															foreach ($jenisbahasa_asing as $row){
																			echo "<option value='$row->id_bahasa_asing'>$row->nama_bahasa_asing</option>";
															}?>
														</select>
													</div>
													<div class="form-group">
														<label for="">Kemampuan Bahasa</label>
														<select class="form-control" name="kemampuan">
															<option value="">Pilih</option>
															<option value='Aktif'>Aktif</option>
															<option value='Pasif'>Pasif</option>
														</select>
													</div>
													<hr>
													<button type="submit" class="btn btn-primary" name="submit_bahasa_asing">Simpan</button>
												</form>
											</div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="keluarga1">
											<div id="table_riwayat_pernikahan">
												<button type="button" id="tambah_riwayat_pernikahan" class="btn btn-primary">Tambah Riwayat Pernikahan</button>
												<hr>
												<div class="table-responsive">
																<table class="table color-table primary-table">
																		<thead>
																				<tr>
																						<th>#</th>
																						<th>Nama</th>
																						<th>Tempat Lahir</th>
																						<th>Tgl. Lahir</th>
																						<th>Tgl. Menikah</th>
																						<th>Pendidikan Umum</th>
																						<th>Pekerjaan</th>
																						<th>Keterangan</th>
																						<th>Status</th>
																						<th>Aksi</th>
																				</tr>
																		</thead>
																		<tbody>
																			<?php foreach ($data_pernikahan as $pernikahan): ?>
																				<tr>
																						<td>1</td>
																						<td><?=isset($pernikahan) ? $pernikahan->nama : "" ?></td>
																						<td><?=isset($pernikahan) ? $pernikahan->tempat_lahir : "" ?></td>
																						<td><?=isset($pernikahan) ? $pernikahan->tgl_lahir : "" ?></td>
																						<td><?=isset($pernikahan) ? $pernikahan->tgl_menikah : "" ?></td>
																						<td><?=isset($pernikahan) ? $pernikahan->nama_jenjangpendidikan : "" ?></td>
																						<td><?=isset($pernikahan) ? $pernikahan->pekerjaan : "" ?></td>
																						<td><?=isset($pernikahan) ? $pernikahan->keterangan : "" ?></td>
																						<td>
																							<?php if ($pernikahan->verifikasi_pegawai == "true" && $pernikahan->verifikasi_bkd == "true"): ?>
																								<span class="label label-success">Sudah Diverifikasi</span>
																								<?php else: ?>
																								<span class="label label-danger">Belum Diverifikasi oleh Pegawai / BKD</span>
																							<?php endif; ?>
																						</td>
																						<td>
																							<?php if ($pernikahan->verifikasi_bkd == false): ?>
																							<button type="submit" class="btn btn-info btn-sm btn-rounded" data-toggle="modal" data-target="#verif_pernikahan<?=$pernikahan->id?>"> <i class="ti-check"></i> </button>
																							<button type="submit" class="btn btn-warning btn-sm btn-rounded" data-toggle="modal" data-target="#catat_pernikahan<?=$pernikahan->id?>"> <i class="ti-pencil"></i> </button>
																							<?php endif; ?>
																							<button type="submit" class="btn btn-danger btn-sm btn-rounded" data-toggle="modal" data-target="#delete_pernikahan<?=$pernikahan->id?>"><i class="ti-trash"></i></button>
																						</td>
																				</tr>
																				<!-- verif row -->
						                            <div class="modal fade bs-example-modal-sm" id="verif_pernikahan<?=$pernikahan->id?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
						                                <div class="modal-dialog modal-sm">
						                                    <div class="modal-content">
						                                        <div class="modal-header" style="background-color:#008efa">
						                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						                                            <h4 class="modal-title" id="myLargeModalLabel" style="color:white">Alert !</h4>
						                                        </div>
						                                        <div class="modal-body">
																											Apakah anda yakin akan memverifikasi data ini ?
						                                        </div>
						                                        <div class="modal-footer">
																											<form method="post">
																												<input type="hidden" name="id_pernikahan" value="<?=$pernikahan->id?>">
																												<button type="submit" class="btn btn-danger waves-effect text-left" name="verif_pernikahan" >Verifikasi</button>
																											</form>
						                                            <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Batal</button>
						                                        </div>
						                                    </div>
						                                    <!-- /.modal-content -->
						                                </div>
						                                <!-- /.modal-dialog -->
						                            </div>
																				<!-- catat row -->
						                            <div class="modal fade bs-example-modal-md" id="catat_pernikahan<?=$pernikahan->id?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
						                                <div class="modal-dialog modal-md">
						                                    <div class="modal-content">
						                                        <div class="modal-header" style="background-color:#f0ad4e">
						                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						                                            <h4 class="modal-title" id="myLargeModalLabel" style="color:white">Alert !</h4>
						                                        </div>
																										<form method="post">
																											<input type="hidden" name="id_pernikahan" value="<?=$pernikahan->id?>">
						                                        <div class="modal-body">
																											Catatan :
																											<textarea name="catatan_verifikasi" class="form-control" rows="8" cols="80"></textarea>
						                                        </div>
						                                        <div class="modal-footer">
																												<button type="submit" class="btn btn-danger waves-effect text-left" name="catat_pernikahan" >Verifikasi</button>
						                                            <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Batal</button>
						                                        </div>
																										</form>
						                                    </div>
						                                    <!-- /.modal-content -->
						                                </div>
						                                <!-- /.modal-dialog -->
						                            </div>
																				<!-- sample modal content -->
																				<div class="modal fade bs-example-modal-sm" id="delete_pernikahan<?=$pernikahan->id?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
																					<div class="modal-dialog modal-sm">
																						<div class="modal-content">
																							<div class="modal-header" style="background-color:#f75b36">
																								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
																								<h4 class="modal-title" id="myLargeModalLabel" style="color:white">Alert !</h4>
																							</div>
																							<div class="modal-body">
																																		Apakah anda yakin akan menghapus data ini ?
																							</div>
																							<div class="modal-footer">
																									<form method="post">
																										<input type="hidden" name="id_pernikahan" value="<?=$pernikahan->id?>">
																										<button type="submit" class="btn btn-danger waves-effect text-left" name="delete_pernikahan" >Hapus</button>
																									</form>
																								<button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Batal</button>
																							</div>
																						</div>
																						<!-- /.modal-content -->
																					</div>
																					<!-- /.modal-dialog -->
																				</div>
																			<?php endforeach; ?>
																		</tbody>
																</table>
														</div>
														<hr>
											</div>
											<div id="form_riwayat_pernikahan">
												<button type="button" id="lihat_riwayat_pernikahan" class="btn btn-primary">Lihat Riwayat Pernikahan</button>
												<hr>
												<form method="post">
													<input type="hidden" name="nip" value="<?=$data_by_bkd->nip?>">
													<div class="form-group">
														<label for="">Nama</label>
														<input type="text" class="form-control" name="nama" value="">
													</div>
													<div class="form-group">
														<label for="">Tempat Lahir</label>
														<input type="text" class="form-control" name="tempat_lahir" value="">
													</div>
													<div class="form-group">
														<label for="">Tgl. Lahir</label>
														<input type="date" class="form-control" name="tgl_lahir" value="">
													</div>
													<div class="form-group">
														<label for="">Tgl. Nikah</label>
														<input type="date" class="form-control" name="tgl_menikah" value="">
													</div>
													<div class="form-group">
														<label for="">Pendidikan Umum</label>
														<select class="form-control" name="id_jenjangpendidikan">
															<option value="">Pilih</option>
															<?php
																foreach ($jenjangpendidikan as $row){
																	echo "<option value='$row->id_jenjangpendidikan'>$row->nama_jenjangpendidikan</option>";
																}
																?>
														</select>
													</div>
													<div class="form-group">
														<label for="">Pekerjaan</label>
														<input type="text" class="form-control" name="pekerjaan" value="">
													</div>
													<div class="form-group">
														<label for="">Keterangan</label>
														<input type="date" class="form-control" name="keterangan" value="">
													</div>
													<hr>
													<button type="submit" class="btn btn-primary" name="submit_pernikahan">Simpan</button>
													<hr>
												</form>
											</div>
											<div id="table_riwayat_anak">
												<button type="button" id="tambah_riwayat_anak" class="btn btn-primary">Tambah Riwayat Anak</button>
												<hr>
												<div class="table-responsive">
																<table class="table color-table primary-table">
																		<thead>
																				<tr>
																						<th>#</th>
																						<th>Nama</th>
																						<th>Tempat Lahir</th>
																						<th>Tgl. Lahir</th>
																						<th>Jenis Kelamin</th>
																						<th>Pendidikan Umum</th>
																						<th>Pekerjaan</th>
																						<th>Keterangan</th>
																						<th>Status</th>
																						<th>Aksi</th>
																				</tr>
																		</thead>
																		<tbody>
																			<?php foreach ($data_anak as $anak): ?>
																				<tr>
																						<td>1</td>
																						<td><?=isset($anak) ? $anak->nama : "" ?></td>
																						<td><?=isset($anak) ? $anak->tempat_lahir : "" ?></td>
																						<td><?=isset($anak) ? $anak->tgl_lahir : "" ?></td>
																						<td><?=isset($anak) ? $anak->jenis_kelamin : "" ?></td>
																						<td><?=isset($anak) ? $anak->nama_jenjangpendidikan : "" ?></td>
																						<td><?=isset($anak) ? $anak->pekerjaan : "" ?></td>
																						<td><?=isset($anak) ? $anak->keterangan : "" ?></td>
																						<td>
																							<?php if ($anak->verifikasi_pegawai == "true" && $anak->verifikasi_bkd == "true"): ?>
																								<span class="label label-success">Sudah Diverifikasi</span>
																								<?php else: ?>
																								<span class="label label-danger">Belum Diverifikasi oleh Pegawai / BKD</span>
																							<?php endif; ?>
																						</td>
																						<td>
																							<?php if ($anak->verifikasi_bkd == false): ?>
																							<button type="submit" class="btn btn-info btn-sm btn-rounded" data-toggle="modal" data-target="#verif_anak<?=$anak->id?>"> <i class="ti-check"></i> </button>
																							<button type="submit" class="btn btn-warning btn-sm btn-rounded" data-toggle="modal" data-target="#catat_anak<?=$anak->id?>"> <i class="ti-pencil"></i> </button>
																							<?php endif; ?>
																							<button type="submit" class="btn btn-danger btn-sm btn-rounded" data-toggle="modal" data-target="#delete_anak<?=$anak->id?>"><i class="ti-trash"></i></button>
																						</td>
																				</tr>
																				<!-- verif row -->
						                            <div class="modal fade bs-example-modal-sm" id="verif_anak<?=$anak->id?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
						                                <div class="modal-dialog modal-sm">
						                                    <div class="modal-content">
						                                        <div class="modal-header" style="background-color:#008efa">
						                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						                                            <h4 class="modal-title" id="myLargeModalLabel" style="color:white">Alert !</h4>
						                                        </div>
						                                        <div class="modal-body">
																											Apakah anda yakin akan memverifikasi data ini ?
						                                        </div>
						                                        <div class="modal-footer">
																											<form method="post">
																												<input type="hidden" name="id_anak" value="<?=$anak->id?>">
																												<button type="submit" class="btn btn-danger waves-effect text-left" name="verif_anak" >Verifikasi</button>
																											</form>
						                                            <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Batal</button>
						                                        </div>
						                                    </div>
						                                    <!-- /.modal-content -->
						                                </div>
						                                <!-- /.modal-dialog -->
						                            </div>
																				<!-- catat row -->
						                            <div class="modal fade bs-example-modal-md" id="catat_anak<?=$anak->id?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
						                                <div class="modal-dialog modal-md">
						                                    <div class="modal-content">
						                                        <div class="modal-header" style="background-color:#f0ad4e">
						                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						                                            <h4 class="modal-title" id="myLargeModalLabel" style="color:white">Alert !</h4>
						                                        </div>
																										<form method="post">
																											<input type="hidden" name="id_anak" value="<?=$anak->id?>">
						                                        <div class="modal-body">
																											Catatan :
																											<textarea name="catatan_verifikasi" class="form-control" rows="8" cols="80"></textarea>
						                                        </div>
						                                        <div class="modal-footer">
																												<button type="submit" class="btn btn-danger waves-effect text-left" name="catat_anak" >Verifikasi</button>
						                                            <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Batal</button>
						                                        </div>
																										</form>
						                                    </div>
						                                    <!-- /.modal-content -->
						                                </div>
						                                <!-- /.modal-dialog -->
						                            </div>
																				<!-- sample modal content -->
																				<div class="modal fade bs-example-modal-sm" id="delete_anak<?=$anak->id?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
																					<div class="modal-dialog modal-sm">
																						<div class="modal-content">
																							<div class="modal-header" style="background-color:#f75b36">
																								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
																								<h4 class="modal-title" id="myLargeModalLabel" style="color:white">Alert !</h4>
																							</div>
																							<div class="modal-body">
																																		Apakah anda yakin akan menghapus data ini ?
																							</div>
																							<div class="modal-footer">
																										<form method="post">
																											<input type="hidden" name="id_anak" value="<?=$anak->id?>">
																											<button type="submit" class="btn btn-danger waves-effect text-left" name="delete_anak" >Hapus</button>
																										</form>
																								<button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Batal</button>
																							</div>
																						</div>
																						<!-- /.modal-content -->
																					</div>
																					<!-- /.modal-dialog -->
																				</div>
																			<?php endforeach; ?>
																		</tbody>
																</table>
														</div>
														<hr>
											</div>
											<div id="form_riwayat_anak">
												<button type="button" id="lihat_riwayat_anak" class="btn btn-primary">Lihat Riwayat Anak</button>
												<hr>
												<form method="post">
													<input type="hidden" name="nip" value="<?=$data_by_bkd->nip?>">
													<div class="form-group">
														<label for="">Nama</label>
														<input type="text" class="form-control" name="nama" value="">
													</div>
													<div class="form-group">
														<label for="">Tempat Lahir</label>
														<input type="text" class="form-control" name="tempat_lahir" value="">
													</div>
													<div class="form-group">
														<label for="">Tgl. Lahir</label>
														<input type="date" class="form-control" name="tgl_lahir" value="">
													</div>
													<div class="form-group">
														<label for="">Jenis Kelamin</label>
														<div class="radio-list">
																<label class="radio-inline p-0">
																		<div class="radio radio-info">
																				<input type="radio" name="jenis_kelamin" id="radio1" value="laki-laki">
																				<label for="radio1">Laki-laki</label>
																		</div>
																</label>
																<label class="radio-inline">
																		<div class="radio radio-info">
																				<input type="radio" name="jenis_kelamin" id="radio2" value="perempuan">
																				<label for="radio2">Perempuan</label>
																		</div>
																</label>
														</div>
													</div>
													<div class="form-group">
														<label for="">Pendidikan Umum</label>
														<select class="form-control" name="id_jenjangpendidikan">
															<option value="">Pilih</option>
															<?php
																foreach ($jenjangpendidikan as $row){
																	echo "<option value='$row->id_jenjangpendidikan'>$row->nama_jenjangpendidikan</option>";
																}
																?>
														</select>
													</div>
													<div class="form-group">
														<label for="">Pekerjaan</label>
														<input type="text" class="form-control" name="pekerjaan" value="">
													</div>
													<div class="form-group">
														<label for="">Keterangan</label>
														<input type="date" class="form-control" name="keterangan" value="">
													</div>
													<hr>
													<button type="submit" class="btn btn-primary" name="submit_anak">Simpan</button>
													<hr>
												</form>
											</div>
											<div id="table_riwayat_orangtua">
												<button type="button" id="tambah_riwayat_orangtua" class="btn btn-primary">Tambah Riwayat Orang Tua</button>
												<hr>
												<div class="table-responsive">
																<table class="table color-table primary-table">
																		<thead>
																				<tr>
																						<th>#</th>
																						<th>Nama</th>
																						<th>Tempat Lahir</th>
																						<th>Tgl. Lahir</th>
																						<th>Jenis Kelamin</th>
																						<th>Pendidikan Umum</th>
																						<th>Pekerjaan</th>
																						<th>Keterangan</th>
																						<th>Status</th>
																						<th>Aksi</th>
																				</tr>
																		</thead>
																		<tbody>
																			<?php foreach ($data_orangtua as $orangtua): ?>
																				<tr>
																						<td>1</td>
																						<td><?=isset($orangtua) ? $orangtua->nama : "" ?></td>
																						<td><?=isset($orangtua) ? $orangtua->tempat_lahir : "" ?></td>
																						<td><?=isset($orangtua) ? $orangtua->tgl_lahir : "" ?></td>
																						<td><?=isset($orangtua) ? $orangtua->jenis_kelamin : "" ?></td>
																						<td><?=isset($orangtua) ? $orangtua->nama_jenjangpendidikan : "" ?></td>
																						<td><?=isset($orangtua) ? $orangtua->pekerjaan : "" ?></td>
																						<td><?=isset($orangtua) ? $orangtua->keterangan : "" ?></td>
																						<td>
																							<?php if ($orangtua->verifikasi_pegawai == "true" && $orangtua->verifikasi_bkd == "true"): ?>
																								<span class="label label-success">Sudah Diverifikasi</span>
																								<?php else: ?>
																								<span class="label label-danger">Belum Diverifikasi oleh Pegawai / BKD</span>
																							<?php endif; ?>
																						</td>
																						<td>
																							<?php if ($orangtua->verifikasi_bkd == false): ?>
																							<button type="submit" class="btn btn-info btn-sm btn-rounded" data-toggle="modal" data-target="#verif_orangtua<?=$orangtua->id?>"> <i class="ti-check"></i> </button>
																							<button type="submit" class="btn btn-warning btn-sm btn-rounded" data-toggle="modal" data-target="#catat_orangtua<?=$orangtua->id?>"> <i class="ti-pencil"></i> </button>
																							<?php endif; ?>
																							<button type="submit" class="btn btn-danger btn-sm btn-rounded" data-toggle="modal" data-target="#delete_orangtua<?=$orangtua->id?>"><i class="ti-trash"></i></button>
																						</td>
																				</tr>
																				<!-- verif row -->
						                            <div class="modal fade bs-example-modal-sm" id="verif_orangtua<?=$orangtua->id?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
						                                <div class="modal-dialog modal-sm">
						                                    <div class="modal-content">
						                                        <div class="modal-header" style="background-color:#008efa">
						                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						                                            <h4 class="modal-title" id="myLargeModalLabel" style="color:white">Alert !</h4>
						                                        </div>
						                                        <div class="modal-body">
																											Apakah anda yakin akan memverifikasi data ini ?
						                                        </div>
						                                        <div class="modal-footer">
																											<form method="post">
																												<input type="hidden" name="id_orangtua" value="<?=$orangtua->id?>">
																												<button type="submit" class="btn btn-danger waves-effect text-left" name="verif_orangtua" >Verifikasi</button>
																											</form>
						                                            <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Batal</button>
						                                        </div>
						                                    </div>
						                                    <!-- /.modal-content -->
						                                </div>
						                                <!-- /.modal-dialog -->
						                            </div>
																				<!-- catat row -->
						                            <div class="modal fade bs-example-modal-md" id="catat_orangtua<?=$orangtua->id?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
						                                <div class="modal-dialog modal-md">
						                                    <div class="modal-content">
						                                        <div class="modal-header" style="background-color:#f0ad4e">
						                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						                                            <h4 class="modal-title" id="myLargeModalLabel" style="color:white">Alert !</h4>
						                                        </div>
																										<form method="post">
																											<input type="hidden" name="id_orangtua" value="<?=$orangtua->id?>">
						                                        <div class="modal-body">
																											Catatan :
																											<textarea name="catatan_verifikasi" class="form-control" rows="8" cols="80"></textarea>
						                                        </div>
						                                        <div class="modal-footer">
																												<button type="submit" class="btn btn-danger waves-effect text-left" name="catat_orangtua" >Verifikasi</button>
						                                            <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Batal</button>
						                                        </div>
																										</form>
						                                    </div>
						                                    <!-- /.modal-content -->
						                                </div>
						                                <!-- /.modal-dialog -->
						                            </div>
																				<!-- sample modal content -->
																				<div class="modal fade bs-example-modal-sm" id="delete_orangtua<?=$orangtua->id?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
																					<div class="modal-dialog modal-sm">
																						<div class="modal-content">
																							<div class="modal-header" style="background-color:#f75b36">
																								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
																								<h4 class="modal-title" id="myLargeModalLabel" style="color:white">Alert !</h4>
																							</div>
																							<div class="modal-body">
																																		Apakah anda yakin akan menghapus data ini ?
																							</div>
																							<div class="modal-footer">
																									<form method="post">
																										<input type="hidden" name="id_orangtua" value="<?=$orangtua->id?>">
																										<button type="submit" class="btn btn-danger waves-effect text-left" name="delete_orangtua" >Hapus</button>
																									</form>
																								<button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Batal</button>
																							</div>
																						</div>
																						<!-- /.modal-content -->
																					</div>
																					<!-- /.modal-dialog -->
																				</div>
																			<?php endforeach; ?>
																		</tbody>
																</table>
														</div>
														<hr>
											</div>
											<div id="form_riwayat_orangtua">
												<button type="button" id="lihat_riwayat_orangtua" class="btn btn-primary">Lihat Riwayat Orang Tua</button>
												<hr>
												<form method="post">
													<input type="hidden" name="nip" value="<?=$data_by_bkd->nip?>">
													<div class="form-group">
														<label for="">Nama</label>
														<input type="text" class="form-control" name="nama" value="">
													</div>
													<div class="form-group">
														<label for="">Tempat Lahir</label>
														<input type="text" class="form-control" name="tempat_lahir" value="">
													</div>
													<div class="form-group">
														<label for="">Tgl. Lahir</label>
														<input type="date" class="form-control" name="tgl_lahir" value="">
													</div>
													<div class="form-group">
														<label for="">Jenis Kelamin</label>
														<div class="radio-list">
		                            <label class="radio-inline p-0">
		                                <div class="radio radio-info">
		                                    <input type="radio" name="jenis_kelamin" id="radio1" value="laki-laki">
		                                    <label for="radio1">Laki-laki</label>
		                                </div>
		                            </label>
		                            <label class="radio-inline">
		                                <div class="radio radio-info">
		                                    <input type="radio" name="jenis_kelamin" id="radio2" value="perempuan">
		                                    <label for="radio2">Perempuan</label>
		                                </div>
		                            </label>
		                        </div>
													</div>
													<div class="form-group">
														<label for="">Pendidikan Umum</label>
														<select class="form-control" name="id_jenjangpendidikan">
															<option value="">Pilih</option>
															<?php
																foreach ($jenjangpendidikan as $row){
																	echo "<option value='$row->id_jenjangpendidikan'>$row->nama_jenjangpendidikan</option>";
																}
																?>
														</select>
													</div>
													<div class="form-group">
														<label for="">Pekerjaan</label>
														<input type="text" class="form-control" name="pekerjaan" value="">
													</div>
													<div class="form-group">
														<label for="">Keterangan</label>
														<input type="date" class="form-control" name="keterangan" value="">
													</div>
													<hr>
													<button type="submit" class="btn btn-primary" name="submit_orangtua">Simpan</button>
													<hr>
												</form>
											</div>
											<div id="table_riwayat_mertua">
												<button type="button" id="tambah_riwayat_mertua" class="btn btn-primary">Tambah Riwayat Mertua</button>
												<hr>
												<div class="table-responsive">
																<table class="table color-table primary-table">
																		<thead>
																				<tr>
																						<th>#</th>
																						<th>Nama</th>
																						<th>Tempat Lahir</th>
																						<th>Tgl. Lahir</th>
																						<th>Jenis Kelamin</th>
																						<th>Pendidikan Umum</th>
																						<th>Pekerjaan</th>
																						<th>Keterangan</th>
																						<th>Status</th>
																						<th>Aksi</th>
																				</tr>
																		</thead>
																		<tbody>
																			<?php foreach ($data_mertua as $mertua): ?>
																				<tr>
																						<td>1</td>
																						<td><?=isset($mertua) ? $mertua->nama : "" ?></td>
																						<td><?=isset($mertua) ? $mertua->tempat_lahir : "" ?></td>
																						<td><?=isset($mertua) ? $mertua->tgl_lahir : "" ?></td>
																						<td><?=isset($mertua) ? $mertua->jenis_kelamin : "" ?></td>
																						<td><?=isset($mertua) ? $mertua->nama_jenjangpendidikan : "" ?></td>
																						<td><?=isset($mertua) ? $mertua->pekerjaan : "" ?></td>
																						<td><?=isset($mertua) ? $mertua->keterangan : "" ?></td>
																						<td>
																							<?php if ($mertua->verifikasi_pegawai == "true" && $mertua->verifikasi_bkd == "true"): ?>
																								<span class="label label-success">Sudah Diverifikasi</span>
																								<?php else: ?>
																								<span class="label label-danger">Belum Diverifikasi oleh Pegawai / BKD</span>
																							<?php endif; ?>
																						</td>
																						<td>
																							<?php if ($mertua->verifikasi_bkd == false): ?>
																							<button type="submit" class="btn btn-info btn-sm btn-rounded" data-toggle="modal" data-target="#verif_mertua<?=$mertua->id?>"> <i class="ti-check"></i> </button>
																							<button type="submit" class="btn btn-warning btn-sm btn-rounded" data-toggle="modal" data-target="#catat_mertua<?=$mertua->id?>"> <i class="ti-pencil"></i> </button>
																							<?php endif; ?>
																							<button type="submit" class="btn btn-danger btn-sm btn-rounded" data-toggle="modal" data-target="#delete_mertua<?=$mertua->id?>"><i class="ti-trash"></i></button>
																						</td>
																				</tr>
																				<!-- verif row -->
						                            <div class="modal fade bs-example-modal-sm" id="verif_mertua<?=$mertua->id?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
						                                <div class="modal-dialog modal-sm">
						                                    <div class="modal-content">
						                                        <div class="modal-header" style="background-color:#008efa">
						                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						                                            <h4 class="modal-title" id="myLargeModalLabel" style="color:white">Alert !</h4>
						                                        </div>
						                                        <div class="modal-body">
																											Apakah anda yakin akan memverifikasi data ini ?
						                                        </div>
						                                        <div class="modal-footer">
																											<form method="post">
																												<input type="hidden" name="id_mertua" value="<?=$mertua->id?>">
																												<button type="submit" class="btn btn-danger waves-effect text-left" name="verif_mertua" >Verifikasi</button>
																											</form>
						                                            <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Batal</button>
						                                        </div>
						                                    </div>
						                                    <!-- /.modal-content -->
						                                </div>
						                                <!-- /.modal-dialog -->
						                            </div>
																				<!-- catat row -->
						                            <div class="modal fade bs-example-modal-md" id="catat_mertua<?=$mertua->id?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
						                                <div class="modal-dialog modal-md">
						                                    <div class="modal-content">
						                                        <div class="modal-header" style="background-color:#f0ad4e">
						                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						                                            <h4 class="modal-title" id="myLargeModalLabel" style="color:white">Alert !</h4>
						                                        </div>
																										<form method="post">
																											<input type="hidden" name="id_mertua" value="<?=$mertua->id?>">
						                                        <div class="modal-body">
																											Catatan :
																											<textarea name="catatan_verifikasi" class="form-control" rows="8" cols="80"></textarea>
						                                        </div>
						                                        <div class="modal-footer">
																												<button type="submit" class="btn btn-danger waves-effect text-left" name="catat_mertua" >Verifikasi</button>
						                                            <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Batal</button>
						                                        </div>
																										</form>
						                                    </div>
						                                    <!-- /.modal-content -->
						                                </div>
						                                <!-- /.modal-dialog -->
						                            </div>
																				<!-- sample modal content -->
																				<div class="modal fade bs-example-modal-sm" id="delete_mertua<?=$mertua->id?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
																					<div class="modal-dialog modal-sm">
																						<div class="modal-content">
																							<div class="modal-header" style="background-color:#f75b36">
																								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
																								<h4 class="modal-title" id="myLargeModalLabel" style="color:white">Alert !</h4>
																							</div>
																							<div class="modal-body">
																																		Apakah anda yakin akan menghapus data ini ?
																							</div>
																							<div class="modal-footer">
																									<form method="post">
																										<input type="hidden" name="id_mertua" value="<?=$mertua->id?>">
																										<button type="submit" class="btn btn-danger waves-effect text-left" name="delete_mertua" >Hapus</button>
																									</form>
																								<button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Batal</button>
																							</div>
																						</div>
																						<!-- /.modal-content -->
																					</div>
																					<!-- /.modal-dialog -->
																				</div>
																			<?php endforeach; ?>
																		</tbody>
																</table>
														</div>
														<hr>
											</div>
											<div id="form_riwayat_mertua">
												<button type="button" id="lihat_riwayat_mertua" class="btn btn-primary">Lihat Riwayat Mertua</button>
												<hr>
												<form method="post">
													<input type="hidden" name="nip" value="<?=$data_by_bkd->nip?>">
													<div class="form-group">
														<label for="">Nama</label>
														<input type="text" class="form-control" name="nama" value="">
													</div>
													<div class="form-group">
														<label for="">Tempat Lahir</label>
														<input type="text" class="form-control" name="tempat_lahir" value="">
													</div>
													<div class="form-group">
														<label for="">Tgl. Lahir</label>
														<input type="date" class="form-control" name="tgl_lahir" value="">
													</div>
													<div class="form-group">
														<label for="">Jenis Kelamin</label>
														<div class="radio-list">
		                            <label class="radio-inline p-0">
		                                <div class="radio radio-info">
		                                    <input type="radio" name="jenis_kelamin" id="radio1" value="laki-laki">
		                                    <label for="radio1">Laki-laki</label>
		                                </div>
		                            </label>
		                            <label class="radio-inline">
		                                <div class="radio radio-info">
		                                    <input type="radio" name="jenis_kelamin" id="radio2" value="perempuan">
		                                    <label for="radio2">Perempuan</label>
		                                </div>
		                            </label>
		                        </div>
													</div>
													<div class="form-group">
														<label for="">Pendidikan Umum</label>
														<select class="form-control" name="id_jenjangpendidikan">
															<option value="">Pilih</option>
															<?php
																foreach ($jenjangpendidikan as $row){
																	echo "<option value='$row->id_jenjangpendidikan'>$row->nama_jenjangpendidikan</option>";
																}
																?>
														</select>
													</div>
													<div class="form-group">
														<label for="">Pekerjaan</label>
														<input type="text" class="form-control" name="pekerjaan" value="">
													</div>
													<div class="form-group">
														<label for="">Keterangan</label>
														<input type="date" class="form-control" name="keterangan" value="">
													</div>
													<hr>
													<button type="submit" class="btn btn-primary" name="submit_mertua">Simpan</button>
													<hr>
												</form>
											</div>
										</div>
                    </div>
                    <!-- <div role="tabpanel" class="tab-pane fade" id="berkas1">
                        <div class="col-md-6">
                            <h3>Just do Settings</h3>
                            <h4>you can use it with the small code</h4>
                        </div>
                        <div class="col-md-5 pull-right">
                            <p>Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a.</p>
                        </div>
                        <div class="clearfix"></div>
                    </div> -->
                </div>

            </div>
        </div>
      	</div>
      </div>
