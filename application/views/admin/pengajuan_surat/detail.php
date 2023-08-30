
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
					<?php if ($pengajuan_surat->status == 'Belum Diverifikasi') {
						$color = '#00b4eb';
						$icon = 'ti-time';
						$disabled = null;
					}else{
						$color = '#5ab190';
						$icon = 'ti-check-box';
						$disabled = 'display:none';
					} ?>
				<span class="label label-primary" style="background-color: <?=$color?>"><i class="<?=$icon?>"></i> <?=$pengajuan_surat->status?></span>
					<span>
                    <?php if ($pengajuan_surat->status == 'Sudah Diverifikasi') { ?>
                    <a href="<?=base_url()?>data/pengajuan_surat/<?=$pengajuan_surat->surat_jadi?>" class="btn btn-primary btn-md pull-right" download><i class="fa fa-envelope"></i> Download Surat</a>
                    <?php } ?>
					<a href="<?=base_url()?>pengajuan_surat/delete/<?=$pengajuan_surat->id_pengajuan_surat?>" onclick="return confirm('Apakah anda yakin menghapus data ini?')" class="btn btn-danger btn-xs pull-right" style="margin-right:5px;<?=$disabled;?>"> <i class="fa fa-trash"></i> Hapus</a>
					</span>
					<span>
					<a href="<?=base_url()?>pengajuan_surat/ubah/<?=$pengajuan_surat->id_pengajuan_surat?>" class="btn btn-success btn-xs pull-right" style="margin-right:5px;<?=$disabled;?>"><i class="fa fa-pencil"></i> Edit</a>
					</span>
				</div>
					<div class="row">
						<div class="col-sm-6">
                                    <table class="table table-bordered">
									    <thead>
                                            <tr>
                                                <th class="text-nowrap" width="150">Jenis Pengajuan Surat</th>
                                                <th><?=$pengajuan_surat->jenis_pengajuan_surat?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
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
                                                <td><a href="<?=base_url()?>data/pengajuan_surat/<?=$pengajuan_surat->jadwal_kuliah?>" class="btn btn-primary btn-xs" download>Download</a></td>
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
