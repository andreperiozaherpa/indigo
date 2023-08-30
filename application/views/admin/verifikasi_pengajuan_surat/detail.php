
<div class="container-fluid">

	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Detail Pengajuan Surat</h4> </div>
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<li class="active">Detail Pengajuan Surat</li>				</ol>
				</div>
				<!-- /.col-lg-12 -->
			</div>


			<div class="row">
            <div class="col-sm-12">
                <div class="white-box" style="border-top: 5px solid #6003c8">
				<div class="row" style="margin-bottom:20px;">
                					<?php if ($this->session->flashdata('error')) { ?>
										<div class="alert alert-danger">
											<?=$this->session->flashdata('error');?>
										</div>
									<?php } ?>
					<?php if ($pengajuan_surat->status == 'Belum Diverifikasi') {
						$color = '#00b4eb';
						$icon = 'ti-time';
						$disabled = null;
					}else{
						$color = '#5ab190';
						$icon = 'ti-check-box';
						$disabled = 'disabled';
					} ?>
				<span class="label label-primary" style="background-color: <?=$color?>"><i class="<?=$icon?>"></i> <?=$pengajuan_surat->status?></span>
					<span>

                            <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 class="modal-title" id="myModalLabel">Verifikasi Pengajuan</h4>
                                        </div>
                                        <div class="modal-body">
                                        <form action="" method="post" enctype="multipart/form-data">
                    						<div class="form-group">
                                            <input type="hidden" name="id_pengajuan_surat" value="<?=$pengajuan_surat->id_pengajuan_surat?>">
                                            <input type="hidden" name="id_pegawai_verifikator" value="<?=$id_pegawai?>">
                                            <input type="hidden" name="status" value="Sudah Diverifikasi">
                                                <label for="">Surat Hasil Pengajuan</label>
                                                <input type="file" name="surat_jadi" id="input-file-max-fs" data-max-file-size="2M" data-allowed-file-extensions="pdf" class="dropify" required/>
                                                <small style="color:red;font-weight:bold;">Format file PDF</small>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" name="verifikasi" class="btn btn-primary" onclick="return confirm('Apakah anda yakin memverifikasi data ini ?')">Verifikasi</button>
                                            <button type="button"  class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->
                            <!-- Button trigger modal -->
                            <?php if ($pengajuan_surat->status == 'Belum Diverifikasi') { ?>
                            <button class="btn btn-success pull-right" data-toggle="modal" data-target="#myModal"><i class="fa fa-check"></i> Verifikasi</button>
                            <?php } ?>

					</span>
				</div>
                <div class="row">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th colspan="2" class="text-nowrap">Identitas Pengaju Surat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-nowrap">
                                NIP
                            </td>
                            <td><?=$pengajuan_surat->nip?></td>
                        </tr>
                        <tr>
                            <td class="text-nowrap">
                                Nama Lengkap
                            </td>
                            <td><?=$pengajuan_surat->nama_lengkap?></td>
                        </tr>
                        <tr>
                            <td class="text-nowrap">
                                Tempat Lahir
                            </td>
                            <td><?=$pengajuan_surat->temlahir?></td>
                        </tr>
                        <tr>
                            <td class="text-nowrap">
                                Tanggal Lahir
                            </td>
                            <td><?=tanggal($pengajuan_surat->tgllahir)?></td>
                        </tr>
                        <tr>
                            <td class="text-nowrap">
                                Pangkat
                            </td>
                            <td><?=$pengajuan_surat->pangkat?></td>
                        </tr>
                        <tr>
                            <td class="text-nowrap">
                                Golongan
                            </td>
                            <td><?=$pengajuan_surat->golongan?></td>
                        </tr>
                        <tr>
                            <td class="text-nowrap">
                                Jabatan
                            </td>
                            <td><?=$pengajuan_surat->jabatan?></td>
                        </tr>
                        <tr>
                            <td class="text-nowrap">
                                OPD/SKPD
                            </td>
                            <td><?=$pengajuan_surat->nama_skpd?></td>
                        </tr>
                        <tr>
                            <td class="text-nowrap">
                                Unit Kerja
                            </td>
                            <td><?=$pengajuan_surat->nama_unit_kerja?></td>
                        </tr>
                    </tbody>
                </table>
                </div>
					<div class="row">
						<div class="col-sm-6">
                                    <table class="table table-bordered">
									    <thead>
                                            <tr>
                                                <th class="text-nowrap" colspan="2" width="150">Isi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-nowrap">
                                                    Jenis Pengajuan Surat
                                                </td>
                                                <td><?=$pengajuan_surat->jenis_pengajuan_surat?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-nowrap">
                                                    Jenjang Pendidikan
                                                </td>
                                                <td><?=$pengajuan_surat->jenjang_pendidikan?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-nowrap">
                                                    Program Studi
                                                </td>
                                                <td><?=$pengajuan_surat->program_studi?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-nowrap">
                                                    Lembaga Pendidikan
                                                </td>
                                                <td><?=$pengajuan_surat->lembaga_pendidikan?></td>
                                            </tr>
											<?php if ($pengajuan_surat->jenis_pengajuan_surat == 'Surat Keterangan Telah Memiliki Ijazah') { ?>
                                            <tr>
                                                <td class="text-nowrap">
                                                    No Ijazah
                                                </td>
                                                <td><?=$pengajuan_surat->no_ijazah?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-nowrap">
                                                    Lembaga Pendidikan
                                                </td>
                                                <td><?=tanggal($pengajuan_surat->tanggal_ijazah)?></td>
                                            </tr>
											<?php } ?>
                                            <tr>
                                                <td class="text-nowrap">
                                                    Nilai PPK PNS / SKP
                                                </td>
                                                <td><?=$pengajuan_surat->nilai_ppk?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-nowrap">
                                                    No HP/WA
                                                </td>
                                                <td><?=$pengajuan_surat->no_hp?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
						<div class="col-sm-6">
                                    <table class="table table-bordered">
									    <thead>
                                            <tr>
                                                <th class="text-nowrap" colspan="2" width="150">Lampiran</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
												<td class="text-nowrap" width="150">Surat Usulan dari OPD</td>
                                                <td><a href="<?=base_url()?>data/pengajuan_surat/<?=$pengajuan_surat->surat_usulan_opd?>" class="btn btn-primary btn-xs" download>Download</a> </td>
                                            </tr>
                                            <tr>
                                                <td class="text-nowrap" width="150">
                                                    Surat Keterangan Tidak Dijatuhi hukuman Disiplin
                                                </td>
                                                <td><a href="<?=base_url()?>data/pengajuan_surat/<?=$pengajuan_surat->sk_tidak_dijatuhi_hukuman_disiplin?>" class="btn btn-primary btn-xs" download>Download</a></td>
                                            </tr>
                                            <tr>
                                                <td class="text-nowrap">
                                                    SK Pangkat Terakhir
                                                </td>
                                                <td><a href="<?=base_url()?>data/pengajuan_surat/<?=$pengajuan_surat->sk_pangkat_terakhir?>" class="btn btn-primary btn-xs" download>Download</a> </td>
                                            </tr>
											<?php if ($pengajuan_surat->jenis_pengajuan_surat == 'Izin Bersekolah') { ?>
                                            <tr>
                                                <td class="text-nowrap">
                                                    Jadwal Kuliah
                                                </td>
                                                <td><a href="<?=base_url()?>data/pengajuan_surat/<?=$pengajuan_surat->jadwal_kuliah?>" class="btn btn-primary btn-xs" download>Download</a> </td>
                                            </tr>
                                            <tr>
                                                <td class="text-nowrap">
                                                    Surat Keterangan dari Lembaga Pendidikan.
                                                </td>
                                                <td><a href="<?=base_url()?>data/pengajuan_surat/<?=$pengajuan_surat->sk_lembaga_pendidikan?>" class="btn btn-primary btn-xs" download>Download</a> </td>
                                            </tr>
											<?php }elseif ($pengajuan_surat->jenis_pengajuan_surat == 'Surat Keterangan Telah Memiliki Ijazah') { ?>
                                            <tr>
                                                <td class="text-nowrap">
                                                    Ijazah (fotocopy dilegalisir).
                                                </td>
                                                <td><a href="<?=base_url()?>data/pengajuan_surat/<?=$pengajuan_surat->fc_ijazah?>" class="btn btn-primary btn-xs" download>Download</a> </td>
                                            </tr>
                                            <tr>
                                                <td class="text-nowrap">
                                                    Transkrip Nilai (fotocopy dilegalisir).
                                                </td>
                                                <td><a href="<?=base_url()?>data/pengajuan_surat/<?=$pengajuan_surat->transkip_nilai?>" class="btn btn-primary btn-xs" download>Download</a> </td>
                                            </tr>
											<?php } ?>
                                        </tbody>
                                    </table>
                                </div>
					</div>
					<div class="row">
					<a href="<?=base_url()?>pengajuan_surat" class="pull-right btn btn-primary btn-outline"><i class="ti-back-left"></i> Kembali</a>
					</div>
                </div>
            </div>
        </div>
