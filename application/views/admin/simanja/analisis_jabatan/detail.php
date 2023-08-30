<div class="container-fluid">

    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Detail Analisis Jabatan</h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

            <ol class="breadcrumb">
                <li><a href="<?= base_url(); ?>admin">Dashboard</a></li>
                <li><a href="<?= base_url('simanja/analisis_jabatan'); ?>">Analisis Jabatan</a></li>
                <li class="active"><?=$detail->nama?></li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
    <!-- .row -->
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <div class="panel panel-default" style="border-top: 10px solid #6003c8">
                        <div class="panel-heading">
                            <?php if($detail->status == 'buka') { ?>
                            <div class="panel-action">
                                <div class="dropdown"> <a class="dropdown-toggle" id="examplePanelDropdown"
                                        data-toggle="dropdown" href="#" aria-expanded="false" role="button">Pilihan Menu
                                        <span class="caret"></span></a>
                                    <ul class="dropdown-menu bullet dropdown-menu-right"
                                        aria-labelledby="examplePanelDropdown" role="menu">
                                        <li role="presentation"><a href="javascript:void(0)"
                                                onclick="editRef(<?=$detail->id?>)"><i class="fa fa-edit"></i><small>
                                                    Sunting Jabatan</small> </a></li>
                                        <li role="presentation"><a href="javascript:void(0)"
                                                onclick="deleteRef(<?=$detail->id?>)"><i class="fa fa-trash"></i><small>
                                                    Hapus Jabatan</small></a></li>
                                        <?php if($sender){ ?>
                                        <?php if(in_array('admin_simanja', $user_privileges) || $user_level == 'Administrator') { ?>
                                        <li class="divider" role="presentation"></li>
                                        <li role="presentation"><a
                                                href="<?=base_url('simanja/analisis_jabatan/export_bkn_word/'.$detail->id)?>"><i
                                                    class="fa fa-file-word-o"></i> <small>Export Word</small></a>
                                        </li>
                                        <?php } ?>
                                        <li class="divider" role="presentation"></li>
                                        <li role="presentation"><a
                                                href="<?=base_url('simanja/analisis_jabatan/export_bkn/'.$detail->id)?>"><i
                                                    class="fa fa-file-pdf-o"></i> <small>Cetak Informasi
                                                    Jabatan</small></a></li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                            <?php } ?>
                            <div class="panel-wrapper collapse in">
                                <div class="panel-body">
                                    <?php if($detail->status == 'tutup') { ?>
                                    <div class="text-center"><i class="fa fa-lock"></i> Jabatan Terkunci <br><br></div>
                                    <?php } ?>
                                    <dl>
                                        <dt>Nama Jabatan</dt>
                                        <dd>
                                            <p class="text-muted">
                                                <mark><?=$detail->nama ?: '-'?></mark>
                                            </p>
                                        </dd>
                                        <dt>Jenis Jabatan</dt>
                                        <dd>
                                            <p class="text-muted">
                                                <mark><?=$detail->jenis_jabatan ?: '-' ?></mark>
                                            </p>
                                        </dd>
                                        <dt>Eselon Jabatan</dt>
                                        <dd>
                                            <p class="text-muted">
                                                <mark><?=$detail->eselon_jabatan ?: '-' ?></mark>
                                            </p>
                                        </dd>
                                        <dt>Kode Jabatan</dt>
                                        <dd>
                                            <p class="text-muted">
                                                <mark><?=$detail->kode ?: '-' ?></mark>
                                            </p>
                                        </dd>
                                        <dt>JPT Pratama</dt>
                                        <dd>
                                            <p class="text-muted">
                                                <mark><?=$detail->namaJptPratama ?: '-' ?></mark>
                                            </p>
                                        </dd>
                                        <dt>Administrator</dt>
                                        <dd>
                                            <p class="text-muted">
                                                <mark><?=$detail->namaAdministrator ?: '-' ?></mark>
                                            </p>
                                        </dd>
                                        <dt>Pengawas</dt>
                                        <dd>
                                            <p class="text-muted">
                                                <mark><?=$detail->namaPengawas ?: '-' ?></mark>
                                            </p>
                                        </dd>
                                        <?php if($detail->jenis_jabatan != 'Struktural'){ ?>
                                        <dt><?=$detail->jenis_jabatan?></dt>
                                        <dd>
                                            <p class="text-muted">
                                                <mark><?=$detail->nama ?: '-'?></mark>
                                            </p>
                                        </dd>
                                        <?php } ?>
                                        <dt>Ikhtisar Jabatan</dt>
                                        <dd>
                                            <p class="text-muted">
                                                <mark><?=$detail->ikhtisar_jabatan ?: '-' ?></mark>
                                            </p>
                                        </dd>
                                        <dt>Progress Pengisian</dt>
                                        <dd>
                                            <p class="text-muted">
                                                <mark>
                                                    <label id="w0"
                                                        class="label <?=($nilai > 0) ? ($nilai > 80) ? 'label-success' : 'label-info' : 'label-danger'?>"><?=$nilai ? number_format($nilai, 0, '.', '') : 0?>%</label>
                                                </mark>
                                            </p>
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if($detail->status == 'buka') { ?>

                    <?php if($hasil_kerja){ ?>
                    <a href="<?=base_url('simanja/analisis_beban_kerja/detail/'.$detail->id)?>"
                        class="btn btn-warning"><i class="fa fa-steam"></i> Analisis Beban Kerja</a>
                    <?php } ?>
                    <?php if($nilai > 1){ ?>
                    <a href="<?=base_url('simanja/evaluasi_jabatan/detail/'.$detail->id)?>" class="btn btn-success"><i
                            class="fa fa-retweet"></i> Evaluasi Jabatan</a>
                    <?php } ?>

                    <?php } ?>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <ul class="nav nav-pills">
                                <li class="tab active">
                                    <a data-toggle="tab" href="#tab_kualifikasi_jabatan" aria-expanded="true"> <span
                                            class="visible-xs"></span><span class="hidden-xs">Kualifikasi Jabatan</span>
                                    </a>
                                </li>
                                <li class="tab">
                                    <a data-toggle="tab" href="#tab_tugas_pokok" aria-expanded="true"> <span
                                            class="visible-xs"></span><span class="hidden-xs">Tugas Pokok</span> </a>
                                </li>
                                <li class="tab">
                                    <a data-toggle="tab" href="#tab_hasil_kerja" aria-expanded="false"> <span
                                            class="visible-xs"></span><span class="hidden-xs">Hasil Kerja</span> </a>
                                </li>
                                <li class="tab">
                                    <a aria-expanded="false" data-toggle="tab" href="#tab_bahan_kerja"> <span
                                            class="visible-xs"></span></span> <span class="hidden-xs">Bahan Kerja</span>
                                    </a>
                                </li>
                                <li class="tab">
                                    <a aria-expanded="false" data-toggle="tab" href="#tab_perangkat_kerja"> <span
                                            class="visible-xs"></span></span> <span class="hidden-xs">Perangkat
                                            Kerja</span> </a>
                                </li>
                                <li class="tab">
                                    <a aria-expanded="false" data-toggle="tab" href="#tab_tanggung_jawab"> <span
                                            class="visible-xs"></span></span> <span class="hidden-xs">Tanggung
                                            Jawab</span> </a>
                                </li>
                                <li class="tab">
                                    <a aria-expanded="false" data-toggle="tab" href="#tab_wewenang"> <span
                                            class="visible-xs"></span></span> <span class="hidden-xs">Wewenang</span>
                                    </a>
                                </li>
                                <li class="tab">
                                    <a aria-expanded="false" data-toggle="tab" href="#tab_korelasi_jabatan"> <span
                                            class="visible-xs"></span></span> <span class="hidden-xs">Korelasi
                                            Jabatan</span> </a>
                                </li>
                                <li class="tab">
                                    <a aria-expanded="false" data-toggle="tab" href="#tab_kondisi_lingkungan_kerja">
                                        <span class="visible-xs"></span></span> <span class="hidden-xs">Kondisi
                                            Lingkungan Kerja</span> </a>
                                </li>
                                <li class="tab">
                                    <a aria-expanded="false" data-toggle="tab" href="#tab_risiko_bahaya"> <span
                                            class="visible-xs"></span></span> <span class="hidden-xs">Risiko
                                            Bahaya</span> </a>
                                </li>
                                <li class="tab">
                                    <a aria-expanded="false" data-toggle="tab" href="#tab_syarat_jabatan"> <span
                                            class="visible-xs"></span></span> <span class="hidden-xs">Syarat
                                            Jabatan</span> </a>
                                </li>
                                <li class="tab">
                                    <a aria-expanded="false" data-toggle="tab" href="#tab_prestasi"> <span
                                            class="visible-xs"></span></span> <span class="hidden-xs">Prestasi</span>
                                    </a>
                                </li>
                                <li class="tab">
                                    <a aria-expanded="false" data-toggle="tab" href="#tab_kelas"> <span
                                            class="visible-xs"></span></span> <span class="hidden-xs">Kelas</span> </a>
                                </li>
                            </ul>
                            <div class="tab-content br-n pn" style="width: 100%">
                                <div id="tab_kualifikasi_jabatan" class="tab-pane active">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Kualifikasi Jabatan
                                                <?php if($detail->status == 'buka') { ?>
                                                <div class="panel-action">
                                                    <?php
                                          if(!$kualifikasi_jabatan){ ?>
                                                    <button class="btn btn-primary" onclick="addKualifikasiJabatan()"><i
                                                            class="fa fa-plus"></i> Tambah</button>
                                                    <?php }else { ?>
                                                    <button class="btn btn-warning"
                                                        onclick="editKualifikasiJabatan(<?=$detail->id?>)"><i
                                                            class="fa fa-pencil"></i></button>
                                                    <!-- <button class="btn btn-danger" onclick="deleteKualifikasiJabatan(1)"><i class="fa fa-trash"></i></button> -->
                                                    <?php } ?>
                                                </div>
                                                <?php } ?>
                                            </div>
                                            <div class="panel-wrapper collapse in">
                                                <div class="panel-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-hover">
                                                            <tbody>
                                                                <?php 
                                                $no = 1;
                                                foreach($kualifikasi_jabatan as $i) { ?>
                                                                <tr>
                                                                    <th>Pendidikan Formal</th>
                                                                    <td><?=$i->pendidikan_formal?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Diklat Penjenjangan</th>
                                                                    <td><?=$i->diklat_perjejangan?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Diklat Teknis</th>
                                                                    <td><?=$i->diklat_teknis?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Pengalaman Kerja</th>
                                                                    <td><?=$i->pengalaman_kerja?></td>
                                                                </tr>
                                                                <?php } ?>
                                                                <?php echo $kualifikasi_jabatan ? null : '<tr><td colspan="3">Belum ada data</td></tr>' ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="tab_tugas_pokok" class="tab-pane">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Tugas Pokok
                                                <?php if($detail->status == 'buka') { ?>
                                                <div class="panel-action">
                                                    <button class="btn btn-primary" onclick="addTugasPokok()"><i
                                                            class="fa fa-plus"></i> Tambah</button>
                                                </div>
                                                <?php } ?>
                                            </div>
                                            <div class="panel-wrapper collapse in">
                                                <div class="panel-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Uraian Tugas</th>
                                                                    <th>Opsi</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php 
                                                $no = 1;
                                                foreach($tugas_pokok as $i) { ?>
                                                                <tr>
                                                                    <td><?=$no++?></td>
                                                                    <td><?=$i->uraian_tugas?></td>
                                                                    <td style="width:150px">
                                                                        <?php if($detail->status == 'buka') { ?>
                                                                        <a href="javascript:void(0)"
                                                                            onclick="editTugasPokok(<?=$i->id?>)"
                                                                            class="btn btn-warning btn-sm"><i
                                                                                class="fa fa-pencil"></i></a>
                                                                        <a href="javascript:void(0)"
                                                                            onclick="deleteTugasPokok(<?=$i->id?>)"
                                                                            class="btn btn-danger btn-sm"><i
                                                                                class="fa fa-trash"></i></a>
                                                                        <?php } ?>
                                                                    </td>
                                                                </tr>
                                                                <?php } ?>
                                                                <?php echo $tugas_pokok ? null : '<tr><td colspan="3">Belum ada data</td></tr>' ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="tab_hasil_kerja" class="tab-pane">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Hasil Kerja
                                                <?php if($detail->status == 'buka') { ?>
                                                <div class="panel-action">
                                                    <button class="btn btn-primary" onclick="addHasilKerja()"><i
                                                            class="fa fa-plus"></i> Tambah</button>
                                                </div>
                                                <?php } ?>
                                            </div>
                                            <div class="panel-wrapper collapse in">
                                                <div class="panel-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Uraian Tugas</th>
                                                                    <th>Hasil Kerja</th>
                                                                    <th>Jumlah Hasil</th>
                                                                    <th>Waktu Penyelesaian per Satuan Hasil Kerja (JAM)
                                                                    </th>
                                                                    <th>Satuan Hasil</th>
                                                                    <th>Opsi</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php 
                                                $no = 1;
                                                foreach($hasil_kerja as $i) { ?>
                                                                <tr>
                                                                    <td><?=$no++?></td>
                                                                    <td><?=$i->uraianTugas?></td>
                                                                    <td><?=$i->hasil_kerja?></td>
                                                                    <td><?=$i->jumlah_hasil?></td>
                                                                    <td><?=$i->waktu_penyelesaian?></td>
                                                                    <td><?=$i->satuan_hasil?></td>
                                                                    <td style="width:150px">
                                                                        <?php if($detail->status == 'buka') { ?>
                                                                        <a href="javascript:void(0)"
                                                                            onclick="editHasilKerja(<?=$i->id?>)"
                                                                            class="btn btn-warning btn-sm"><i
                                                                                class="fa fa-pencil"></i></a>
                                                                        <a href="javascript:void(0)"
                                                                            onclick="deleteHasilKerja(<?=$i->id?>)"
                                                                            class="btn btn-danger btn-sm"><i
                                                                                class="fa fa-trash"></i></a>
                                                                        <?php } ?>
                                                                    </td>
                                                                </tr>
                                                                <?php } ?>
                                                                <?php echo $hasil_kerja ? null : '<tr><td colspan="3">Belum ada data</td></tr>' ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="tab_bahan_kerja" class="tab-pane">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Bahan Kerja
                                                <?php if($detail->status == 'buka') { ?>
                                                <div class="panel-action">
                                                    <button class="btn btn-primary" onclick="addBahanKerja()"><i
                                                            class="fa fa-plus"></i> Tambah</button>
                                                </div>
                                                <?php } ?>
                                            </div>
                                            <div class="panel-wrapper collapse in">
                                                <div class="panel-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Bahan Kerja</th>
                                                                    <th>Penggunaaan Dalam Tugas</th>
                                                                    <th>Opsi</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php 
                                                $no = 1;
                                                foreach($bahan_kerja as $i) { ?>
                                                                <tr>
                                                                    <td><?=$no++?></td>
                                                                    <td><?=$i->bahan_kerja?></td>
                                                                    <td><?=$i->penggunaan_dalam_tugas?></td>
                                                                    <td style="width:150px">
                                                                        <?php if($detail->status == 'buka') { ?>
                                                                        <a href="javascript:void(0)"
                                                                            onclick="editBahanKerja(<?=$i->id?>)"
                                                                            class="btn btn-warning btn-sm"><i
                                                                                class="fa fa-pencil"></i></a>
                                                                        <a href="javascript:void(0)"
                                                                            onclick="deleteBahanKerja(<?=$i->id?>)"
                                                                            class="btn btn-danger btn-sm"><i
                                                                                class="fa fa-trash"></i></a>
                                                                        <?php } ?>
                                                                    </td>
                                                                </tr>
                                                                <?php } ?>
                                                                <?php echo $bahan_kerja ? null : '<tr><td colspan="3">Belum ada data</td></tr>' ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="tab_perangkat_kerja" class="tab-pane">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Perangkat Kerja
                                                <?php if($detail->status == 'buka') { ?>
                                                <div class="panel-action">
                                                    <button class="btn btn-primary" onclick="addPerangkatKerja()"><i
                                                            class="fa fa-plus"></i> Tambah</button>
                                                </div>
                                                <?php } ?>
                                            </div>
                                            <div class="panel-wrapper collapse in">
                                                <div class="panel-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Bahan Kerja</th>
                                                                    <th>Penggunaaan Dalam Tugas</th>
                                                                    <th>Opsi</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php 
                                                $no = 1;
                                                foreach($perangkat_kerja as $i) { ?>
                                                                <tr>
                                                                    <td><?=$no++?></td>
                                                                    <td><?=$i->perangkat_kerja?></td>
                                                                    <td><?=$i->penggunaan_dalam_tugas?></td>
                                                                    <td style="width:150px">
                                                                        <?php if($detail->status == 'buka') { ?>
                                                                        <a href="javascript:void(0)"
                                                                            onclick="editPerangkatKerja(<?=$i->id?>)"
                                                                            class="btn btn-warning btn-sm"><i
                                                                                class="fa fa-pencil"></i></a>
                                                                        <a href="javascript:void(0)"
                                                                            onclick="deletePerangkatKerja(<?=$i->id?>)"
                                                                            class="btn btn-danger btn-sm"><i
                                                                                class="fa fa-trash"></i></a>
                                                                        <?php } ?>
                                                                    </td>
                                                                </tr>
                                                                <?php } ?>
                                                                <?php echo $perangkat_kerja ? null : '<tr><td colspan="3">Belum ada data</td></tr>' ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="tab_tanggung_jawab" class="tab-pane">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Tanggung Jawab
                                                <?php if($detail->status == 'buka') { ?>
                                                <div class="panel-action">
                                                    <button class="btn btn-primary" onclick="addTanggungJawab()"><i
                                                            class="fa fa-plus"></i> Tambah</button>
                                                </div>
                                                <?php } ?>
                                            </div>
                                            <div class="panel-wrapper collapse in">
                                                <div class="panel-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Tanggung Jawab</th>
                                                                    <th>Opsi</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php 
                                                $no = 1;
                                                foreach($tanggung_jawab as $i) { ?>
                                                                <tr>
                                                                    <td><?=$no++?></td>
                                                                    <td><?=$i->tanggung_jawab?></td>
                                                                    <td style="width:150px">
                                                                        <?php if($detail->status == 'buka') { ?>
                                                                        <a href="javascript:void(0)"
                                                                            onclick="editTanggungJawab(<?=$i->id?>)"
                                                                            class="btn btn-warning btn-sm"><i
                                                                                class="fa fa-pencil"></i></a>
                                                                        <a href="javascript:void(0)"
                                                                            onclick="deleteTanggungJawab(<?=$i->id?>)"
                                                                            class="btn btn-danger btn-sm"><i
                                                                                class="fa fa-trash"></i></a>
                                                                        <?php } ?>
                                                                    </td>
                                                                </tr>
                                                                <?php } ?>
                                                                <?php echo $tanggung_jawab ? null : '<tr><td colspan="3">Belum ada data</td></tr>' ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="tab_wewenang" class="tab-pane">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Wewenang
                                                <?php if($detail->status == 'buka') { ?>
                                                <div class="panel-action">
                                                    <button class="btn btn-primary" onclick="addWewenang()"><i
                                                            class="fa fa-plus"></i> Tambah</button>
                                                </div>
                                                <?php } ?>
                                            </div>
                                            <div class="panel-wrapper collapse in">
                                                <div class="panel-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Wewenang</th>
                                                                    <th>Opsi</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php 
                                                $no = 1;
                                                foreach($wewenang as $i) { ?>
                                                                <tr>
                                                                    <td><?=$no++?></td>
                                                                    <td><?=$i->wewenang?></td>
                                                                    <td style="width:150px">
                                                                        <?php if($detail->status == 'buka') { ?>
                                                                        <a href="javascript:void(0)"
                                                                            onclick="editWewenang(<?=$i->id?>)"
                                                                            class="btn btn-warning btn-sm"><i
                                                                                class="fa fa-pencil"></i></a>
                                                                        <a href="javascript:void(0)"
                                                                            onclick="deleteWewenang(<?=$i->id?>)"
                                                                            class="btn btn-danger btn-sm"><i
                                                                                class="fa fa-trash"></i></a>
                                                                        <?php } ?>
                                                                    </td>
                                                                </tr>
                                                                <?php } ?>
                                                                <?php echo $wewenang ? null : '<tr><td colspan="3">Belum ada data</td></tr>' ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="tab_korelasi_jabatan" class="tab-pane">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Korelasi Jabatan
                                                <?php if($detail->status == 'buka') { ?>
                                                <div class="panel-action">
                                                    <button class="btn btn-primary" onclick="addKorelasiJabatan()"><i
                                                            class="fa fa-plus"></i> Tambah</button>
                                                </div>
                                                <?php } ?>
                                            </div>
                                            <div class="panel-wrapper collapse in">
                                                <div class="panel-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Jabatan</th>
                                                                    <th>Unit Kerja</th>
                                                                    <th>Hubungan Tugas</th>
                                                                    <th>Opsi</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php 
                                              $no = 1;
                                              foreach($korelasi_jabatan as $i) { ?>
                                                                <tr>
                                                                    <td><?=$no++?></td>
                                                                    <td><?=$i->jabatan?></td>
                                                                    <td><?=$i->unit_kerja?></td>
                                                                    <td><?=$i->hubungan_tugas?></td>
                                                                    <td style="width:150px">
                                                                        <a href="javascript:void(0)"
                                                                            onclick="editKorelasiJabatan(<?=$i->id?>)"
                                                                            class="btn btn-warning btn-sm"><i
                                                                                class="fa fa-pencil"></i></a>
                                                                        <a href="javascript:void(0)"
                                                                            onclick="deleteKorelasiJabatan(<?=$i->id?>)"
                                                                            class="btn btn-danger btn-sm"><i
                                                                                class="fa fa-trash"></i></a>
                                                                    </td>
                                                                </tr>
                                                                <?php } ?>
                                                                <?php echo $korelasi_jabatan ? null : '<tr><td colspan="3">Belum ada data</td></tr>' ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="tab_kondisi_lingkungan_kerja" class="tab-pane">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Kondisi Lingkungan Kerja
                                                <?php if($detail->status == 'buka') { ?>
                                                <div class="panel-action">
                                                    <?php if(!$kondisi_lingkungan_kerja){ ?>
                                                    <button class="btn btn-primary"
                                                        onclick="addKondisiLingkunganKerja()"><i class="fa fa-plus"></i>
                                                        Tambah</button>
                                                    <?php }else { ?>
                                                    <button class="btn btn-warning"
                                                        onclick="editKondisiLingkunganKerja(<?=$detail->id?>)"><i
                                                            class="fa fa-pencil"></i></button>
                                                    <!-- <button class="btn btn-danger" onclick="deleteKondisiLingkunganKerja(1)"><i class="fa fa-trash"></i></button> -->
                                                    <?php } ?>
                                                </div>
                                                <?php } ?>
                                            </div>
                                            <div class="panel-wrapper collapse in">
                                                <div class="panel-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Aspek</th>
                                                                    <th>Faktor</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php 
                                                $no = 1;
                                                foreach($kondisi_lingkungan_kerja as $i) { ?>
                                                                <tr>
                                                                    <td>1</td>
                                                                    <td>Tempat Kerja</td>
                                                                    <td><?=$i->tempat_kerja?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>2</td>
                                                                    <td>Suhu</td>
                                                                    <td><?=$i->suhu?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>3</td>
                                                                    <td>Udara</td>
                                                                    <td><?=$i->udara?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>4</td>
                                                                    <td>Keadaan Ruangan</td>
                                                                    <td><?=$i->keadaan_ruangan?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>5</td>
                                                                    <td>Letak</td>
                                                                    <td><?=$i->letak?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>6</td>
                                                                    <td>Penerangan</td>
                                                                    <td><?=$i->penerangan?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>7</td>
                                                                    <td>Suara</td>
                                                                    <td><?=$i->suara?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>8</td>
                                                                    <td>Keadaaan Tempat Kerja</td>
                                                                    <td><?=$i->keadaan_tempat_kerja?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>9</td>
                                                                    <td>Getaran</td>
                                                                    <td><?=$i->getaran?></td>
                                                                </tr>
                                                                <?php } ?>
                                                                <?php echo $kondisi_lingkungan_kerja ? null : '<tr><td colspan="3">Belum ada data</td></tr>' ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="tab_risiko_bahaya" class="tab-pane">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Risiko Bahaya
                                                <?php if($detail->status == 'buka') { ?>
                                                <div class="panel-action">
                                                    <button class="btn btn-primary" onclick="addRisikoBahaya()"><i
                                                            class="fa fa-plus"></i> Tambah</button>
                                                </div>
                                                <?php } ?>
                                            </div>
                                            <div class="panel-wrapper collapse in">
                                                <div class="panel-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Risiko</th>
                                                                    <th>Penyebab</th>
                                                                    <th>Opsi</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php 
                                                $no = 1;
                                                foreach($risiko_bahaya as $i) { ?>
                                                                <tr>
                                                                    <td><?=$no++?></td>
                                                                    <td><?=$i->risiko?></td>
                                                                    <td><?=$i->penyebab?></td>
                                                                    <td style="width:150px">
                                                                        <?php if($detail->status == 'buka') { ?>
                                                                        <a href="javascript:void(0)"
                                                                            onclick="editRisikoBahaya(<?=$i->id?>)"
                                                                            class="btn btn-warning btn-sm"><i
                                                                                class="fa fa-pencil"></i></a>
                                                                        <a href="javascript:void(0)"
                                                                            onclick="deleteRisikoBahaya(<?=$i->id?>)"
                                                                            class="btn btn-danger btn-sm"><i
                                                                                class="fa fa-trash"></i></a>
                                                                        <?php } ?>
                                                                    </td>
                                                                </tr>
                                                                <?php } ?>
                                                                <?php echo $risiko_bahaya ? null : '<tr><td colspan="3">Belum ada data</td></tr>' ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="tab_syarat_jabatan" class="tab-pane">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Keterampilan Kerja
                                                <?php if($detail->status == 'buka') { ?>
                                                <div class="panel-action">
                                                    <button class="btn btn-primary"
                                                        onclick="addKeterampilanKerja(<?=$detail->id?>)"><i
                                                            class="fa fa-cog"></i> Manage</button>
                                                </div>
                                                <?php } ?>
                                            </div>
                                            <div class="panel-wrapper collapse in">
                                                <div class="panel-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Keterampilan Kerja</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php 
                                                $no = 1;
                                                foreach($keterampilan_kerja as $i) { ?>
                                                                <tr>
                                                                    <td><?=$no++?></td>
                                                                    <td><?=$i->keterampilan_kerja?></td>
                                                                </tr>
                                                                <?php } ?>
                                                                <?php echo $keterampilan_kerja ? null : '<tr><td colspan="3">Belum ada data</td></tr>' ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Bakat Kerja
                                                <?php if($detail->status == 'buka') { ?>
                                                <div class="panel-action">
                                                    <button class="btn btn-primary"
                                                        onclick="addBakatKerja(<?=$detail->id?>)"><i
                                                            class="fa fa-cog"></i> Manage</button>
                                                </div>
                                                <?php } ?>
                                            </div>
                                            <div class="panel-wrapper collapse in">
                                                <div class="panel-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Bakat Kerja</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php 
                                                $no = 1;
                                                foreach($bakat_kerja as $i) { ?>
                                                                <tr>
                                                                    <td><?=$no++?></td>
                                                                    <td><?=$i->bakat_kerja?></td>
                                                                </tr>
                                                                <?php } ?>
                                                                <?php echo $bakat_kerja ? null : '<tr><td colspan="3">Belum ada data</td></tr>' ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Temperamen Kerja
                                                <?php if($detail->status == 'buka') { ?>
                                                <div class="panel-action">
                                                    <button class="btn btn-primary"
                                                        onclick="addTemperamenKerja(<?=$detail->id?>)"><i
                                                            class="fa fa-cog"></i> Manage</button>
                                                </div>
                                                <?php } ?>
                                            </div>
                                            <div class="panel-wrapper collapse in">
                                                <div class="panel-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Temperamen Kerja</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php 
                                                $no = 1;
                                                foreach($temperamen_kerja as $i) { ?>
                                                                <tr>
                                                                    <td><?=$no++?></td>
                                                                    <td><?=$i->temperamen_kerja?></td>
                                                                </tr>
                                                                <?php } ?>
                                                                <?php echo $temperamen_kerja ? null : '<tr><td colspan="3">Belum ada data</td></tr>' ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Minat Kerja
                                                <?php if($detail->status == 'buka') { ?>
                                                <div class="panel-action">
                                                    <button class="btn btn-primary"
                                                        onclick="addMinatKerja(<?=$detail->id?>)"><i
                                                            class="fa fa-cog"></i> Manage</button>
                                                </div>
                                                <?php } ?>
                                            </div>
                                            <div class="panel-wrapper collapse in">
                                                <div class="panel-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Minat Kerja</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php 
                                                $no = 1;
                                                foreach($minat_kerja as $i) { ?>
                                                                <tr>
                                                                    <td><?=$no++?></td>
                                                                    <td><?=$i->minat_kerja?></td>
                                                                </tr>
                                                                <?php } ?>
                                                                <?php echo $minat_kerja ? null : '<tr><td colspan="3">Belum ada data</td></tr>' ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Upaya Fisik
                                                <?php if($detail->status == 'buka') { ?>
                                                <div class="panel-action">
                                                    <button class="btn btn-primary"
                                                        onclick="addUpayaFisik(<?=$detail->id?>)"><i
                                                            class="fa fa-cog"></i> Manage</button>
                                                </div>
                                                <?php } ?>
                                            </div>
                                            <div class="panel-wrapper collapse in">
                                                <div class="panel-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Upaya Fisik</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php 
                                                $no = 1;
                                                foreach($upaya_fisik as $i) { ?>
                                                                <tr>
                                                                    <td><?=$no++?></td>
                                                                    <td><?=$i->upaya_fisik?></td>
                                                                </tr>
                                                                <?php } ?>
                                                                <?php echo $upaya_fisik ? null : '<tr><td colspan="3">Belum ada data</td></tr>' ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Kondisi Fisik
                                                <?php if($detail->status == 'buka') { ?>
                                                <div class="panel-action">
                                                    <?php if(!$kondisi_fisik){ ?>
                                                    <button class="btn btn-primary" onclick="addKondisiFisik()"><i
                                                            class="fa fa-plus"></i> Tambah</button>
                                                    <?php }else { ?>
                                                    <button class="btn btn-warning"
                                                        onclick="editKondisiFisik(<?=$detail->id?>)"><i
                                                            class="fa fa-pencil"></i></button>
                                                    <!-- <button class="btn btn-danger" onclick="deleteKondisiLingkunganKerja(1)"><i class="fa fa-trash"></i></button> -->
                                                    <?php } ?>
                                                </div>
                                                <?php } ?>
                                            </div>
                                            <div class="panel-wrapper collapse in">
                                                <div class="panel-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Aspek</th>
                                                                    <th>Faktor</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php 
                                                $no = 1;
                                                foreach($kondisi_fisik as $i) { ?>
                                                                <tr>
                                                                    <td>1</td>
                                                                    <td>Jenis Kelamin</td>
                                                                    <td><?=$i->jenis_kelamin?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>2</td>
                                                                    <td>Umur</td>
                                                                    <td><?=$i->umur ?: 'Tidak ada syarat khusus'?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>3</td>
                                                                    <td>Tinggi Badan</td>
                                                                    <td><?=$i->tinggi_badan ?: 'Tidak ada syarat khusus'?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>4</td>
                                                                    <td>Berat Badan</td>
                                                                    <td><?=$i->berat_badan ?: 'Tidak ada syarat khusus'?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>5</td>
                                                                    <td>Postur Badan</td>
                                                                    <td><?=$i->postur_badan ?: 'Tidak ada syarat khusus'?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>6</td>
                                                                    <td>Penampilan</td>
                                                                    <td><?=$i->penampilan?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>7</td>
                                                                    <td>Keadaan Fisik</td>
                                                                    <td><?=$i->keadaan_fisik?></td>
                                                                </tr>
                                                                <?php } ?>
                                                                <?php echo $kondisi_fisik ? null : '<tr><td colspan="3">Belum ada data</td></tr>' ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Fungsi Pekerjaan
                                                <?php if($detail->status == 'buka') { ?>
                                                <div class="panel-action">
                                                    <button class="btn btn-primary"
                                                        onclick="addFungsiPekerjaan(<?=$detail->id?>)"><i
                                                            class="fa fa-cog"></i> Manage</button>
                                                </div>
                                                <?php } ?>
                                            </div>
                                            <div class="panel-wrapper collapse in">
                                                <div class="panel-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Fungsi Pekerjaan</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php 
                                                $no = 1;
                                                foreach($fungsi_pekerjaan as $i) { ?>
                                                                <tr>
                                                                    <td><?=$no++?></td>
                                                                    <td><?=$i->fungsi_pekerjaan?></td>
                                                                </tr>
                                                                <?php } ?>
                                                                <?php echo $fungsi_pekerjaan ? null : '<tr><td colspan="3">Belum ada data</td></tr>' ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="tab_prestasi" class="tab-pane">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="container">
                                            <h2><?=$prestasi?></h2>
                                        </div>
                                    </div>
                                </div>
                                <div id="tab_kelas" class="tab-pane">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="container">
                                            <h2><?=$kelas?></h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if($detail->status == 'buka') { ?>
                    <?php if(!$sender){ ?>
                    <?php if($nilai == 100){ ?>
                    <a href="javascript:void(0)" onclick="addSend(<?=$detail->id?>)"
                        class="btn btn-primary pull-right"><i class="fa fa-paper-plane"></i> Kirim Anjab ABK</a>
                    <?php } ?>
                    <?php } ?>
                    <?php if($sender) {
            if($sender->is_active == 1) {  ?>
                    <div class="pull-right">
                        <?php if($sender->status == 1){ ?>
                        <span class="label label-info" data-toggle="tooltip" data-placement="top"
                            title="Pemangku Jabatan (<?=$sender->namaPemangku?>)"><i class="fa fa-spinner"></i> Menunggu
                            verifikasi atasan (<?=$sender->namaVerifikator?>)</span>
                        <?php }else if($sender->status == 2) { ?>
                        <span class="label label-success" data-toggle="tooltip" data-placement="top"
                            title="Pemangku Jabatan (<?=$sender->namaPemangku?>)"><i class="fa fa-check"></i> Menunggu
                            verifikasi SETDA</span>
                        <?php }else if($sender->status == 3) { ?>
                        <span class="label label-success" data-toggle="tooltip" data-placement="top"
                            title="Pemangku Jabatan (<?=$sender->namaPemangku?>)"><i class="fa fa-check"></i>
                            Terverifikasi</span>
                        <?php }else if($sender->status == 4) { ?>
                        <span class="label label-danger" data-toggle="tooltip" data-placement="top"
                            title="Pemangku Jabatan (<?=$sender->namaPemangku?>)"><i class="fa fa-close"></i> Ditolak
                            atasan (<?=$sender->namaVerifikator?>), alasan penolakan bisa dicek <a style="color:white"
                                target="_blank" href="<?=base_url('simanja/verifikasi')?>">disini</a> </span>
                        <?php }else if($sender->status == 5) { ?>
                        <span class="label label-danger" data-toggle="tooltip" data-placement="top"
                            title="Pemangku Jabatan (<?=$sender->namaPemangku?>)"><i class="fa fa-close"></i> Ditolak
                            SETDA , alasan penolakan bisa dicek <a style="color:white" target="_blank"
                                href="<?=base_url('simanja/verifikasi')?>">disini</a></span>
                        <?php } ?>
                        <br>
                        <small><a href="javascript:void(0)" onclick="addSend(<?=$detail->id?>)">Kirim ulang
                                ?</a></small>
                    </div>
                    <?php }
           } ?>
                    <?php } ?>
                </div>
            </div>
        </div>
        <!-- .row -->

        <div id="modalKualifikasiJabatan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel1">Ubah</h4>
                    </div>
                    <div class="modal-body">
                        <form id="formKualifikasiJabatan">
                            <div id="hiddenKualifikasiJabatan"></div>
                            <div id="messageKualifikasiJabatan"></div>
                            <?php $disabled = ($this->session->userdata('level') != 'Administrator')? "disabled" : "";?>
                            <input type="hidden" name="id_analisis_jabatan" value="<?=$detail->id?>">
                            <div class="form-group">
                                <label for="message-text" class="control-label">Pendidikan Formal</label>
                                <textarea class="form-control" name="pendidikan_formal"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="control-label">Diklat Penjenjangan</label>
                                <textarea class="form-control" name="diklat_perjejangan"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="control-label">Diklat Teknis</label>
                                <textarea class="form-control" name="diklat_teknis"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="control-label">Pengalaman Kerja</label>
                                <textarea class="form-control" name="pengalaman_kerja"></textarea>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" onclick="simpanKualifikasiJabatan()" id="btnSaveKualifikasiJabatan"
                            class="btn btn-primary">Simpan</button>
                    </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
        </div>

        <div id="modalReferensi" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel1">Ubah</h4>
                    </div>
                    <div class="modal-body">
                        <form id="formRef">
                            <div id="hiddenRef"></div>
                            <div id="messageRef"></div>
                            <input type="hidden" name="id_ref" value="<?=$detail->id?>" />
                            <?php $disabled = ($this->session->userdata('level') != 'Administrator')? "disabled" : "";?>
                            <div class="form-group">
                                <label for="message-text" class="control-label">Jenis Jabatan <sup class="text-danger"
                                        title="wajib diisi">*</sup></label>
                                <select class="form-control" id="jenis_jabatan" name="jenis_jabatan"
                                    onchange="jenisPegawaiChange(this.value)" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="Struktural"
                                        <?=($detail->jenis_jabatan == 'Struktural') ? 'selected' : null?>>Struktural
                                    </option>
                                    <option value="Fungsional"
                                        <?=($detail->jenis_jabatan == 'Fungsional') ? 'selected' : null?>>Fungsional
                                    </option>
                                    <option value="Pelaksana"
                                        <?=($detail->jenis_jabatan == 'Pelaksana') ? 'selected' : null?>>Pelaksana
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="control-label">Nama <sup class="text-danger"
                                        title="wajib diisi">*</sup> </label>
                                <div id="name_struktural"
                                    style="display: <?=($detail->jenis_jabatan != 'Struktural') ? 'none' : 'block'?>">
                                    <input type="text" name="nama" id="nama_1" class="form-control"
                                        placeholder=" Masukkan Nama Jabatan" value="<?=$detail->nama?>" required>
                                </div>
                                <div id="name_other"
                                    style="display: <?=($detail->jenis_jabatan != 'Struktural') ? 'block' : 'none'?>">
                                    <select class="form-control select2" name="id_ref_jabatan" id="nama"
                                        onchange="chooseJabatanOther(this.value)">
                                        <option value="">-- Pilih --</option>
                                        <?php foreach($ref_jabatan as $item){ ?>
                                        <option value="<?=$item->id?>"
                                            <?=($item->id == $detail->id_ref_jabatan) ? 'selected' : null?>>
                                            <?=$item->nama?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="control-label">OPD/SKPD</label>
                                <select class="form-control select2" onchange="unitKerja(this.value)" name="id_skpd"
                                    id="id_skpd">
                                    <option value="">-- Pilih --</option>
                                    <?php foreach($skpd as $i){ ?>
                                    <?php if($this->session->userdata('level') == 'Administrator' || in_array('admin_simanja', $user_privileges)){ ?>
                                    <option value="<?=$i->id_skpd?>" data-type="<?=$i->jenis_skpd?>"
                                        <?=($detail->id_skpd == $i->id_skpd) ? 'selected' : null?>><?=$i->nama_skpd?>
                                    </option>
                                    <?php }else{ ?>
                                    <?php if($detail->id_skpd == $i->id_skpd) { ?>
                                    <option value="<?=$i->id_skpd?>" data-type="<?=$i->jenis_skpd?>" selected>
                                        <?=$i->nama_skpd?></option>
                                    <?php } ?>
                                    <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group"
                                style="<?=($detail->jenis_jabatan != 'Struktural') ? 'display:none' : null?>"
                                id="jenis_pegawai_fg">
                                <label for="message-text" class="control-label">Jenis Pegawai Struktural <sup
                                        class="text-danger" title="wajib diisi">*</sup></label>
                                <select class="form-control" id="jenis_pegawai" name="jenis_pegawai" required>
                                    <option value="JPT Pratama"
                                        <?=($detail->jenis_pegawai == 'JPT Pratama') ? 'selected' : null?>>JPT Pratama
                                    </option>
                                    <option value="Administrator"
                                        <?=($detail->jenis_pegawai == 'Administrator') ? 'selected' : null?>>
                                        Administrator</option>
                                    <option value="Pengawas"
                                        <?=($detail->jenis_pegawai == 'Pengawas') ? 'selected' : null?>>Pengawas
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="control-label">JPT Pratama</label>
                                <select class="form-control select2" id="jpt_pratama" name="jpt_pratama"
                                    onchange="unitKerjaInduk(this.value)">
                                    <option value="">-- Pilih --</option>
                                    <?php foreach($jpt_pratama as $item){ ?>
                                    <option value="<?=$item->id?>"
                                        <?=($detail->jpt_pratama == $item->id) ? 'selected' : null?>><?=$item->nama?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="control-label">Administrator</label>
                                <select class="form-control select2" id="administrator" name="administrator"
                                    onchange="unitKerjaIndukPengawas(this.value)">
                                    <option value="">-- Pilih --</option>
                                    <?php foreach($administrator as $item){ ?>
                                    <option value="<?=$item->id?>"
                                        <?=($detail->administrator == $item->id) ? 'selected' : null?>><?=$item->nama?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="control-label">Pengawas</label>
                                <select class="form-control select2" id="pengawas" name="pengawas">
                                    <option value="">-- Pilih --</option>
                                    <?php foreach($pengawas as $item){ ?>
                                    <option value="<?=$item->id?>"
                                        <?=($detail->pengawas == $item->id) ? 'selected' : null?>><?=$item->nama?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="control-label">Eselon Jabatan</label>
                                <select id="eselon_jabatan" class="form-control" name="eselon_jabatan">
                                    <option value="">-- Pilih --</option>
                                    <option value="II/a" <?=($detail->eselon_jabatan == 'II/a') ? 'selected' : null?>>
                                        II/a</option>
                                    <option value="II/b" <?=($detail->eselon_jabatan == 'II/b') ? 'selected' : null?>>
                                        II/b</option>
                                    <option value="III/a" <?=($detail->eselon_jabatan == 'III/a') ? 'selected' : null?>>
                                        III/a</option>
                                    <option value="III/b" <?=($detail->eselon_jabatan == 'III/b') ? 'selected' : null?>>
                                        III/b</option>
                                    <option value="IV/a" <?=($detail->eselon_jabatan == 'IV/a') ? 'selected' : null?>>
                                        IV/a</option>
                                    <option value="IV/b" <?=($detail->eselon_jabatan == 'IV/b') ? 'selected' : null?>>
                                        IV/b</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="control-label">Ikhtisar Jabatan</label>
                                <textarea name="ikhtisar_jabatan" class="form-control"
                                    rows="5"><?=$detail->ikhtisar_jabatan?></textarea>
                            </div>
                            <!-- <div class="form-group">
              <label for="message-text" class="control-label">Urutan</label>
              <input type="number" name="urutan" class="form-control" placeholder="Masukkan Urutan Jabatan" <?=$disabled?>>
            </div> -->
                            <!-- <div class="form-group">
              <label for="message-text" class="control-label">Status</label>
              <select class="form-control" name="status">
                <option value="Buka">Buka</option>
                <option value="Kunci">Kunci</option>
              </select>
            </div> -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" onclick="simpanRef()" id="btnSaveRef"
                            class="btn btn-primary">Simpan</button>
                    </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
        </div>

        <div id="modalTugasPokok" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel1">Ubah</h4>
                    </div>
                    <div class="modal-body">
                        <form id="formTugasPokok">
                            <div id="hiddenTugasPokok"></div>
                            <div id="messageTugasPokok"></div>
                            <?php $disabled = ($this->session->userdata('level') != 'Administrator')? "disabled" : "";?>
                            <div class="form-group">
                                <input type="hidden" name="id_analisis_jabatan" value="<?=$detail->id?>">
                                <label for="message-text" class="control-label">Uraian Tugas <sup class="text-danger"
                                        title="wajib diisi">*</sup> </label>
                                <textarea class="form-control" name="uraian_tugas" required></textarea>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" onclick="simpanTugasPokok()" id="btnSaveTugasPokok"
                            class="btn btn-primary">Simpan</button>
                    </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
        </div>

        <div id="modalHasilKerja" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel1">Ubah</h4>
                    </div>
                    <div class="modal-body">
                        <form id="formHasilKerja">
                            <div id="hiddenHasilKerja"></div>
                            <div id="messageHasilKerja"></div>
                            <?php $disabled = ($this->session->userdata('level') != 'Administrator')? "disabled" : "";?>
                            <input type="hidden" name="id_analisis_jabatan" value="<?=$detail->id?>">
                            <div class="form-group">
                                <label for="message-text" class="control-label">Uraian Tugas <sup class="text-danger"
                                        title="wajib diisi">*</sup> </label>
                                <select class="form-control" name="id_tugas_pokok">
                                    <?php foreach($tugas_pokok as $i) { ?>
                                    <option value="<?=$i->id?>"><?=$i->uraian_tugas?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="control-label">Hasil Kerja <sup class="text-danger"
                                        title="wajib diisi">*</sup> </label>
                                <textarea class="form-control" name="hasil_kerja"></textarea>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Jumlah Hasil</label>
                                <input class="form-control" name="jumlah_hasil" type="number">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Waktu Penyelesaian per Satuan Hasil Kerja (dalam
                                    JAM)</label>
                                <input class="form-control" name="waktu_penyelesaian" type="text">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="control-label">Satuan Hasil <sup class="text-danger"
                                        title="wajib diisi">*</sup> </label>
                                <select class="form-control" name="id_satuan_hasil">
                                    <?php foreach($satuan_hasil as $i) { ?>
                                    <option value="<?=$i->id?>"><?=$i->nama?></option>
                                    <?php } ?>
                                </select>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" onclick="simpanHasilKerja()" id="btnSaveHasilKerja"
                            class="btn btn-primary">Simpan</button>
                    </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
        </div>

        <div id="modalBahanKerja" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel1">Ubah</h4>
                    </div>
                    <div class="modal-body">
                        <form id="formBahanKerja">
                            <div id="hiddenBahanKerja"></div>
                            <div id="messageBahanKerja"></div>
                            <?php $disabled = ($this->session->userdata('level') != 'Administrator')? "disabled" : "";?>
                            <input type="hidden" name="id_analisis_jabatan" value="<?=$detail->id?>">
                            <div class="form-group">
                                <label for="message-text" class="control-label">Bahan Kerja <sup class="text-danger"
                                        title="wajib diisi">*</sup> </label>
                                <input class="form-control" name="bahan_kerja" required>
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="control-label">Penggunaan Dalam Tugas</label>
                                <textarea class="form-control" name="penggunaan_dalam_tugas"></textarea>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" onclick="simpanBahanKerja()" id="btnSaveBahanKerja"
                            class="btn btn-primary">Simpan</button>
                    </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
        </div>

        <div id="modalPerangkatKerja" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel1">Ubah</h4>
                    </div>
                    <div class="modal-body">
                        <form id="formPerangkatKerja">
                            <div id="hiddenPerangkatKerja"></div>
                            <div id="messagePerangkatKerja"></div>
                            <?php $disabled = ($this->session->userdata('level') != 'Administrator')? "disabled" : "";?>
                            <input type="hidden" name="id_analisis_jabatan" value="<?=$detail->id?>">
                            <div class="form-group">
                                <label for="message-text" class="control-label">Perangkat Kerja <sup class="text-danger"
                                        title="wajib diisi">*</sup> </label>
                                <input class="form-control" name="perangkat_kerja" required>
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="control-label">Penggunaan Dalam Tugas</label>
                                <textarea class="form-control" name="penggunaan_dalam_tugas"></textarea>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" onclick="simpanPerangkatKerja()" id="btnSavePerangkatKerja"
                            class="btn btn-primary">Simpan</button>
                    </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
        </div>

        <div id="modalTanggungJawab" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel1">Ubah</h4>
                    </div>
                    <div class="modal-body">
                        <form id="formTanggungJawab">
                            <div id="hiddenTanggungJawab"></div>
                            <div id="messageTanggungJawab"></div>
                            <?php $disabled = ($this->session->userdata('level') != 'Administrator')? "disabled" : "";?>
                            <input type="hidden" name="id_analisis_jabatan" value="<?=$detail->id?>">
                            <div class="form-group">
                                <label for="message-text" class="control-label">Tanggung Jawab</label>
                                <textarea class="form-control" name="tanggung_jawab"></textarea>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" onclick="simpanTanggungJawab()" id="btnSaveTanggungJawab"
                            class="btn btn-primary">Simpan</button>
                    </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
        </div>

        <div id="modalWewenang" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel1">Ubah</h4>
                    </div>
                    <div class="modal-body">
                        <form id="formWewenang">
                            <div id="hiddenWewenang"></div>
                            <div id="messageWewenang"></div>
                            <?php $disabled = ($this->session->userdata('level') != 'Administrator')? "disabled" : "";?>
                            <input type="hidden" name="id_analisis_jabatan" value="<?=$detail->id?>">
                            <div class="form-group">
                                <label for="message-text" class="control-label">Wewenang</label>
                                <textarea class="form-control" name="wewenang"></textarea>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" onclick="simpanWewenang()" id="btnSaveWewenang"
                            class="btn btn-primary">Simpan</button>
                    </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
        </div>

        <div id="modalKorelasiJabatan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel1">Ubah</h4>
                    </div>
                    <div class="modal-body">
                        <form id="formKorelasiJabatan">
                            <div id="hiddenKorelasiJabatan"></div>
                            <div id="messageKorelasiJabatan"></div>
                            <?php $disabled = ($this->session->userdata('level') != 'Administrator')? "disabled" : "";?>
                            <input type="hidden" name="id_analisis_jabatan" value="<?=$detail->id?>">
                            <div class="form-group">
                                <label for="message-text" class="control-label">Jabatan</label>
                                <input class="form-control" name="jabatan">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="control-label">Unit Kerja</label>
                                <input class="form-control" name="unit_kerja">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="control-label">Hubungan Tugas</label>
                                <textarea class="form-control" name="hubungan_tugas"></textarea>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" onclick="simpanKorelasiJabatan()" id="btnSaveKorelasiJabatan"
                            class="btn btn-primary">Simpan</button>
                    </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
        </div>

        <div id="modalKondisiLingkunganKerja" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel1">Ubah</h4>
                    </div>
                    <div class="modal-body">
                        <form id="formKondisiLingkunganKerja">
                            <div id="hiddenKondisiLingkunganKerja"></div>
                            <div id="messageKondisiLingkunganKerja"></div>
                            <?php $disabled = ($this->session->userdata('level') != 'Administrator')? "disabled" : "";?>
                            <input type="hidden" name="id_analisis_jabatan" value="<?=$detail->id?>">
                            <div class="form-group">
                                <label for="message-text" class="control-label">Tempat Kerja</label>
                                <input class="form-control" name="tempat_kerja">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="control-label">Suhu</label>
                                <input class="form-control" name="suhu">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="control-label">Udara</label>
                                <input class="form-control" name="udara">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="control-label">Keadaan Ruangan</label>
                                <input class="form-control" name="keadaan_ruangan">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="control-label">Letak</label>
                                <input class="form-control" name="letak">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="control-label">Penerangan</label>
                                <input class="form-control" name="penerangan">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="control-label">Suara</label>
                                <input class="form-control" name="suara">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="control-label">Keadaan tempat kerja</label>
                                <input class="form-control" name="keadaan_tempat_kerja">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="control-label">Getaran</label>
                                <input class="form-control" name="getaran">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" onclick="simpanKondisiLingkunganKerja()"
                            id="btnSaveKondisiLingkunganKerja" class="btn btn-primary">Simpan</button>
                    </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
        </div>

        <div id="modalRisikoBahaya" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel1">Ubah</h4>
                    </div>
                    <div class="modal-body">
                        <form id="formRisikoBahaya">
                            <div id="hiddenRisikoBahaya"></div>
                            <div id="messageRisikoBahaya"></div>
                            <?php $disabled = ($this->session->userdata('level') != 'Administrator')? "disabled" : "";?>
                            <input type="hidden" name="id_analisis_jabatan" value="<?=$detail->id?>">
                            <div class="form-group">
                                <label for="message-text" class="control-label">Risiko</label>
                                <input class="form-control" name="risiko">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="control-label">Penyebab</label>
                                <input class="form-control" name="penyebab">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" onclick="simpanRisikoBahaya()" id="btnSaveRisikoBahaya"
                            class="btn btn-primary">Simpan</button>
                    </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
        </div>

        <div id="modalBakatKerja" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel1">Ubah</h4>
                    </div>
                    <div class="modal-body">
                        <form id="formBakatKerja">
                            <div id="hiddenBakatKerja"></div>
                            <div id="messageBakatKerja"></div>
                            <?php $disabled = ($this->session->userdata('level') != 'Administrator')? "disabled" : "";?>
                            <input type="hidden" name="id_analisis_jabatan" value="<?=$detail->id?>">
                            <div class="form-group">
                                <select class="select2" id="bakat-kerja-select2" name="listed[]" multiple="multiple">
                                    <?php foreach($ref_bakat_kerja as $i) { ?>
                                    <option value="<?=$i->id?>"><?=$i->kode?> = <?=$i->arti?></option>
                                    <?php } ?>
                                </select>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" onclick="simpanBakatKerja()" id="btnSaveBakatKerja"
                            class="btn btn-primary">Simpan</button>
                    </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
        </div>

        <div id="modalKeterampilanKerja" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel1">Ubah</h4>
                    </div>
                    <div class="modal-body">
                        <form id="formKeterampilanKerja">
                            <div id="hiddenKeterampilanKerja"></div>
                            <div id="messageKeterampilanKerja"></div>
                            <?php $disabled = ($this->session->userdata('level') != 'Administrator')? "disabled" : "";?>
                            <input type="hidden" name="id_analisis_jabatan" value="<?=$detail->id?>">
                            <div class="form-group">
                                <select class="select2" id="keterampilan-kerja-select2" name="listed[]"
                                    multiple="multiple">
                                    <?php foreach($ref_keterampilan_kerja as $i) { ?>
                                    <option value="<?=$i->id?>"><?=$i->nama?></option>
                                    <?php } ?>
                                </select>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" onclick="simpanKeterampilanKerja()" id="btnSaveKeterampilanKerja"
                            class="btn btn-primary">Simpan</button>
                    </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
        </div>

        <div id="modalTemperamenKerja" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel1">Ubah</h4>
                    </div>
                    <div class="modal-body">
                        <form id="formTemperamenKerja">
                            <div id="hiddenTemperamenKerja"></div>
                            <div id="messageTemperamenKerja"></div>
                            <?php $disabled = ($this->session->userdata('level') != 'Administrator')? "disabled" : "";?>
                            <input type="hidden" name="id_analisis_jabatan" value="<?=$detail->id?>">
                            <div class="form-group">
                                <select class="select2" id="temperamen-kerja-select2" name="listed[]"
                                    multiple="multiple">
                                    <?php foreach($ref_temperamen_kerja as $i) { ?>
                                    <option value="<?=$i->id?>"><?=$i->kode?> <?=$i->arti?></option>
                                    <?php } ?>
                                </select>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" onclick="simpanTemperamenKerja()" id="btnSaveTemperamenKerja"
                            class="btn btn-primary">Simpan</button>
                    </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
        </div>

        <div id="modalMinatKerja" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel1">Ubah</h4>
                    </div>
                    <div class="modal-body">
                        <form id="formMinatKerja">
                            <div id="hiddenMinatKerja"></div>
                            <div id="messageMinatKerja"></div>
                            <?php $disabled = ($this->session->userdata('level') != 'Administrator')? "disabled" : "";?>
                            <input type="hidden" name="id_analisis_jabatan" value="<?=$detail->id?>">
                            <div class="form-group">
                                <select class="select2" id="minat-kerja-select2" name="listed[]" multiple="multiple">
                                    <?php foreach($ref_minat_kerja as $i) { ?>
                                    <option value="<?=$i->id?>"><?=$i->kode.' = '.$i->penjelasan?></option>
                                    <?php } ?>
                                </select>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" onclick="simpanMinatKerja()" id="btnSaveMinatKerja"
                            class="btn btn-primary">Simpan</button>
                    </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
        </div>

        <div id="modalUpayaFisik" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel1">Ubah</h4>
                    </div>
                    <div class="modal-body">
                        <form id="formUpayaFisik">
                            <div id="hiddenUpayaFisik"></div>
                            <div id="messageUpayaFisik"></div>
                            <?php $disabled = ($this->session->userdata('level') != 'Administrator')? "disabled" : "";?>
                            <input type="hidden" name="id_analisis_jabatan" value="<?=$detail->id?>">
                            <div class="form-group">
                                <select class="select2" id="upaya-fisik-select2" name="listed[]" multiple="multiple">
                                    <?php foreach($ref_upaya_fisik as $i) { ?>
                                    <option value="<?=$i->id?>"><?=$i->kode?></option>
                                    <?php } ?>
                                </select>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" onclick="simpanUpayaFisik()" id="btnSaveUpayaFisik"
                            class="btn btn-primary">Simpan</button>
                    </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
        </div>

        <div id="modalKondisiFisik" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel1">Ubah</h4>
                    </div>
                    <div class="modal-body">
                        <form id="formKondisiFisik">
                            <div id="hiddenKondisiFisik"></div>
                            <div id="messageKondisiFisik"></div>
                            <?php $disabled = ($this->session->userdata('level') != 'Administrator')? "disabled" : "";?>
                            <input type="hidden" name="id_analisis_jabatan" value="<?=$detail->id?>">
                            <div class="form-group">
                                <label for="message-text" class="control-label">Jenis Kelamin</label>
                                <select class="form-control" name="jenis_kelamin">
                                    <option value="Pria">Pria</option>
                                    <option value="Wanita">Wanita</option>
                                    <option value="Pria/Wanita">Pria/Wanita</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="control-label">Umur (Optional) </label>
                                <input class="form-control" name="umur" value="Tidak ada syarat khusus">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="control-label">Tinggi Badan (Optional) </label>
                                <input class="form-control" name="tinggi_badan" value="Tidak ada syarat khusus">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="control-label">Berat Badan (Optional) </label>
                                <input class="form-control" name="berat_badan" value="Tidak ada syarat khusus">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="control-label">Postur Badan (Optional) </label>
                                <input class="form-control" name="postur_badan" value="Tidak ada syarat khusus">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="control-label">Penampilan</label>
                                <input class="form-control" name="penampilan" value="Tidak ada syarat khusus">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="control-label">Keadaan Fisik</label>
                                <select class="form-control" name="keadaan_fisik">
                                    <option value="Disabilitas / Non Disabilitas">Disabilitas / Non Disabilitas</option>
                                    <option value="Non Disabilitas">Non Disabilitas</option>
                                </select>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" onclick="simpanKondisiFisik()" id="btnSaveKondisiFisik"
                            class="btn btn-primary">Simpan</button>
                    </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
        </div>

        <div id="modalFungsiPekerjaan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel1">Ubah</h4>
                    </div>
                    <div class="modal-body">
                        <form id="formFungsiPekerjaan">
                            <div id="hiddenFungsiPekerjaan"></div>
                            <div id="messageFungsiPekerjaan"></div>
                            <?php $disabled = ($this->session->userdata('level') != 'Administrator')? "disabled" : "";?>
                            <input type="hidden" name="id_analisis_jabatan" value="<?=$detail->id?>">
                            <div class="form-group">
                                <select class="select2" id="fungsi-pekerjaan-select2" name="listed[]"
                                    multiple="multiple">
                                    <?php foreach($ref_fungsi_pekerjaan as $i) { ?>
                                    <option value="<?=$i->id?>"><?=$i->kode.' : '.$i->keterangan?></option>
                                    <?php } ?>
                                </select>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" onclick="simpanFungsiPekerjaan()" id="btnSaveFungsiPekerjaan"
                            class="btn btn-primary">Simpan</button>
                    </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
        </div>

        <div id="modalSend" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel1">Ubah</h4>
                    </div>
                    <div class="modal-body">
                        <form id="formSend">
                            <div id="hiddenSend"></div>
                            <div id="messageSend"></div>
                            <?php $disabled = ($this->session->userdata('level') != 'Administrator')? "disabled" : "";?>
                            <input type="hidden" name="id_analisis_jabatan" value="<?=$detail->id?>">
                            <div class="form-group">
                                <label for="message-text" class="control-label">Pemangku Jabatan atau
                                    Penganalisis</label>
                                <select class="form-control select2" name="id_pegawai">
                                    <option value="">-- Pilih --</option>
                                    <?php foreach($pegawai as $i){ ?>
                                    <option value="<?=$i->id_pegawai?>"><?=$i->nama_lengkap?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="control-label">Atasan Langsung</label>
                                <select class="form-control select2" name="id_verifikator">
                                    <option value="">-- Pilih --</option>
                                    <?php foreach($pegawai as $i){ ?>
                                    <option value="<?=$i->id_pegawai?>"><?=$i->nama_lengkap?></option>
                                    <?php } ?>
                                </select>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" onclick="simpanSend()" id="btnSaveSend"
                            class="btn btn-primary">Simpan</button>
                    </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
        </div>

    </div>

    <script>
    //DETAIL 
    let process = null;
    const base_detail_anjab = "<?=base_url('simanja/analisis_jabatan/detail/'.$detail->id)?>"

    function pegawai(id) {
        $.ajax({
            url: "<?= base_url() . 'simanja/analisis_jabatan/fetch_pegawai/' ?>" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                let html = ''
                data.forEach((e, i) => {
                    html += '<option value="' + e.id_pegawai + '">' + e.nama_lengkap + '</option>'
                })
                $('#id_pegawai').html(html)
                $('#id_verifikator').html(html)
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Gagal mendapatkan data unit kerja");
            }
        })
    }

    function jenisPegawaiChange(val) {
        $('#jenis_pegawai_fg').hide();
        $('#name_struktural').hide();
        $('#name_other').hide();
        if (val == 'Struktural') {
            $('#jenis_pegawai_fg').show();
            $('#name_struktural').show();
            $('#name_struktural').trigger('change');
        } else {
            $('#name_other').show();
            $('#name_other').trigger('change');
            $.ajax({
                url: "<?= base_url() . 'simanja/analisis_jabatan/fetch_jabatan/' ?>" + val,
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    console.log(data)
                    let html = ''
                    data.forEach((e, i) => {
                        html += '<option value="' + e.id + '">' + e.nama + '</option>'
                    })

                    $('#nama').html(html)

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert("Gagal mendapatkan data");
                }
            })
        }
    }

    function unitKerja(id) {
        let type = $("#id_skpd").select2().find(":selected").data('type');
        console.log(type)
        if (type != 'kecamatan' && id != '') {
            $.ajax({
                url: "<?= base_url() . 'simanja/analisis_jabatan/fetch_unit_kerja/' ?>" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('#jpt_pratama').val("").change();
                    let html = '<option value="">-- Pilih --</option>'
                    data.forEach((e, i) => {
                        html += '<option value="' + e.id + '">' + e.nama + '</option>'
                    })
                    $('#jpt_pratama').html(html)
                    $('#administrator').val("").change();
                    $('#pengawas').val("").change();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert("Gagal mendapatkan data");
                }
            })
        } else {
            $('#jpt_pratama,#administrator,#pengawas').each(function() {
                $(this).empty()
                    .append('<option value="">-- Pilih --</option>')
                    .val('').change()
            })
            unitKerjaInduk(id)
        }
    }

    function unitKerjaInduk(id) {
        let type = $("#id_skpd").select2().find(":selected").data('type');
        if (id !== '') {
            let url = 'simanja/analisis_jabatan/fetch_unit_kerja_induk/' + id;
            if (type === 'kecamatan') {
                url = 'simanja/analisis_jabatan/fetch_unit_kerja_induk_type/' + id + '/Administrator';
            }
            $.ajax({
                url: "<?= base_url()?>" + url,
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('#administrator').val("");
                    $('#administrator').trigger('change');
                    $('#pengawas').val("");
                    $('#pengawas').trigger('change');
                    let html = '<option value="">-- Pilih --</option>'
                    data.forEach((e, i) => {
                        html += '<option value="' + e.id + '">' + e.nama + '</option>'
                    })
                    $('#administrator').html(html)
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert("Gagal mendapatkan data");
                }
            })
        } else {
            $('#administrator,#pengawas').each(function() {
                $(this).empty()
                    .append('<option value="">-- Pilih --</option>')
                    .val('').change()
            })
        }
    }

    function unitKerjaIndukPengawas(id) {
        let val = $('#administrator').val();
        if (typeof val === 'string' && val !== '') {
            $.ajax({
                url: "<?= base_url() . 'simanja/analisis_jabatan/fetch_unit_kerja_induk/' ?>" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('#pengawas').val("");
                    $('#pengawas').trigger('change');
                    let html = '<option value="">-- Pilih --</option>';
                    data.forEach((e, i) => {
                        html += '<option value="' + e.id + '">' + e.nama + '</option>'
                    })
                    $('#pengawas').html(html)
                    $('#pengawas').val("");
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert("Gagal mendapatkan data");
                }
            })
        } else {
            $('#pengawas').empty().append('<option value="">-- Pilih --</option>')
                .val('').change()
        }
    }

    function chooseJabatanOther(id) {
        $.ajax({
            url: "<?= base_url() . 'simanja/analisis_jabatan/fetch_jabatan_id/' ?>" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('#nama_1').val(data.nama);
                $('[name="ikhtisar_jabatan"]').val(data.tugas);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Gagal mendapatkan data");
            }
        })
    }

    function editRef(id) {
        save_method = 'update';
        let jenis_jabatan = '<?=$detail->jenis_jabatan?>';
        $('#formRef')[0].reset();
        $('#messageRef').html('');
        $('.form-group').removeClass('has-error');
        $('#hiddenRef').html('<input type="hidden" value="" name="id_ref"/>');
        $('.help-block').empty();
        $('#modalReferensi').modal('show');
    }

    function simpanRef() {
        var nama = $('[name="nama"]').val();
        var jenis_jabatan = $('[name="jenis_jabatan"]').val();

        if (!nama) {
            alert('Nama Jabatan harus diisi')
        }

        if (!jenis_jabatan) {
            alert('Jenis Jabatan harus diisi')
        }

        if (nama !== '' && jenis_jabatan !== '') {
            $('#btnSaveRef').text('Menyimpan...');
            $('#messageRef').html('');
            $('#btnSaveRef').attr('disabled', true);
            var url;
            var formData = new FormData($('#formRef')[0]);
            if (save_method == 'add') {
                url = "<?= base_url() . 'simanja/analisis_jabatan/p_add_ref' ?>";
            } else {
                url = "<?= base_url() . 'simanja/analisis_jabatan/p_update_ref' ?>";
            }

            $.ajax({
                url: url,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function(data) {

                    if (data.status) {
                        $('#modalReferensi').modal('hide');
                        swal("Berhasil", "Data Berhasil Disimpan!", "success");
                        location.reload();
                    } else {
                        $('#messageRef').html('<div class="alert alert-danger">' + data.message + '</div>');
                    }
                    $('#btnSaveRef').text('Simpan');
                    $('#btnSaveRef').attr('disabled', false);


                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error adding / update data');
                    $('#btnSaveRef').text('Simpan');
                    $('#btnSaveRef').attr('disabled', false);

                }
            });
        }
    }

    function deleteRef(id) {
        swal({
                title: "Hapus Data",
                text: "Apakah anda yakin akan menghapus data ini?",
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
                        url: "<?= base_url() . 'simanja/analisis_jabatan/delete_ref/' ?>" + id,
                        type: "POST",
                        dataType: "JSON",
                        success: function(data) {
                            $('#modalReferensi').modal('hide');
                            swal("Berhasil", "Data Berhasil Dihapus!", "success");
                            window.location.href = "<?=base_url('simanja/analisis_jabatan')?>";
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            alert('Error deleting data');
                        }
                    });
                }
            });

    }

    //Kualifikasi Jabatan
    function addKualifikasiJabatan() {
        save_method = 'add';
        $('#formKualifikasiJabatan')[0].reset();
        $('#messageKualifikasiJabatan').html('');
        $('#modalKualifikasiJabatan').modal('show');
        let id_ref_jabatan = '<?=$detail->id_ref_jabatan?>';
        if (id_ref_jabatan != '') {
            $.ajax({
                url: "<?= base_url() . 'simanja/analisis_jabatan/fetch_jabatan_id/' ?>" + id_ref_jabatan,
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    console.log(data.kualifikasi_pendidikan)
                    $('[name="pendidikan_formal"]').val(data.kualifikasi_pendidikan);
                    $('[name="diklat_perjejangan"]').val(data.diklat_perjejangan);
                    $('[name="diklat_teknis"]').val(data.diklat_teknis);
                    $('[name="pengalaman_kerja"]').val(data.pengalaman_kerja);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert("Gagal mendapatkan data");
                }
            })
        }
        $('.modal-title').text('Tambah');
    }

    function editKualifikasiJabatan(id) {
        save_method = 'update';
        $('#formKualifikasiJabatan')[0].reset();
        $('#messageKualifikasiJabatan').html('');
        $('.form-group').removeClass('has-error');
        $('#hiddenKualifikasiJabatan').html('<input type="hidden" value="" name="id_kualifikasi_jabatan"/>');
        $('.help-block').empty();
        $.ajax({
            url: "<?= base_url() . 'simanja/analisis_jabatan/fetch_kualifikasi_jabatan/' ?>" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('[name="id_kualifikasi_jabatan"]').val(data.id);
                $('[name="pendidikan_formal"]').val(data.pendidikan_formal);
                $('[name="diklat_perjejangan"]').val(data.diklat_perjejangan);
                $('[name="diklat_teknis"]').val(data.diklat_teknis);
                $('[name="pengalaman_kerja"]').val(data.pengalaman_kerja);
                $('#modalKualifikasiJabatan').modal('show');
                $('.modal-title').text('Ubah');

            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Gagal mendapatkan data");
            }
        });
    }

    function simpanKualifikasiJabatan() {
        var pendidikan_formal = $('[name="pendidikan_formal"]').val();
        var diklat_perjejangan = $('[name="diklat_perjejangan"]').val();
        var diklat_teknis = $('[name="diklat_teknis"]').val();
        var pengalaman_kerja = $('[name="pengalaman_kerja"]').val();

        if (pendidikan_formal === null) {
            alert('Pendidikan Formal harus diisi')
        }
        if (diklat_perjejangan === null) {
            alert('Diklat Perjejangan harus diisi')
        }
        if (diklat_teknis === null) {
            alert('Diklat Teknis harus diisi')
        }
        if (pengalaman_kerja === null) {
            alert('Pengalaman Kerja harus diisi')
        }

        if (pendidikan_formal !== null && diklat_perjejangan !== null & diklat_teknis !== null && pengalaman_kerja !==
            null) {
            $('#btnSaveKualifikasiJabatan').text('Menyimpan...');
            $('#messageKualifikasiJabatan').html('');
            $('#btnSaveKualifikasiJabatan').attr('disabled', true);
            var url;
            var formData = new FormData($('#formKualifikasiJabatan')[0]);
            if (save_method == 'add') {
                url = "<?= base_url() . 'simanja/analisis_jabatan/p_add_kualifikasi_jabatan' ?>";
            } else {
                url = "<?= base_url() . 'simanja/analisis_jabatan/p_update_kualifikasi_jabatan' ?>";
            }

            $.ajax({
                url: url,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function(data) {

                    if (data.status) {
                        $('#modalKualifikasiJabatan').modal('hide');
                        swal("Berhasil", "Data Berhasil Disimpan!", "success");
                        location.reload();
                    } else {
                        $('#messageKualifikasiJabatan').html('<div class="alert alert-danger">' + data
                            .message + '</div>');
                    }
                    $('#btnSaveKualifikasiJabatan').text('Simpan');
                    $('#btnSaveKualifikasiJabatan').attr('disabled', false);


                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error adding / update data');
                    $('#btnSaveKualifikasiJabatan').text('Simpan');
                    $('#btnSaveKualifikasiJabatan').attr('disabled', false);

                }
            });
        }
    }

    function deleteKualifikasiJabatan(id) {
        swal({
                title: "Hapus Data",
                text: "Apakah anda yakin akan menghapus data ini?",
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
                        url: "<?= base_url() . 'simanja/analisis_jabatan/delete_kualifikasi_jabatan/' ?>" +
                            id,
                        type: "POST",
                        dataType: "JSON",
                        success: function(data) {
                            $('#modalKualifikasiJabatan').modal('hide');
                            swal("Berhasil", "Data Berhasil Dihapus!", "success");
                            location.reload();
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            alert('Error deleting data');
                        }
                    });
                }
            });
    }

    //Tugas Pokok
    function addTugasPokok() {
        save_method = 'add';
        $('#formTugasPokok')[0].reset();
        $('#messageTugasPokok').html('');
        $('#modalTugasPokok').modal('show');
        $('.modal-title').text('Tambah');
    }

    function editTugasPokok(id) {
        save_method = 'update';
        $('#formTugasPokok')[0].reset();
        $('#messageTugasPokok').html('');
        $('.form-group').removeClass('has-error');
        $('#hiddenTugasPokok').html('<input type="hidden" value="" name="id_tugas_pokok"/>');
        $('.help-block').empty();
        $.ajax({
            url: "<?= base_url() . 'simanja/analisis_jabatan/fetch_tugas_pokok/' ?>" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('[name="id_tugas_pokok"]').val(data.id);
                $('[name="uraian_tugas"]').val(data.uraian_tugas);
                $('#modalTugasPokok').modal('show');
                $('.modal-title').text('Ubah');

            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Gagal mendapatkan data");
            }
        });

    }

    function simpanTugasPokok() {
        var uraian_tugas = $('[name="uraian_tugas"]').val();

        if (!uraian_tugas) {
            alert('Uraian Tugas Jabatan harus diisi')
        }

        if (uraian_tugas !== '') {
            $('#btnSaveTugasPokok').text('Menyimpan...');
            $('#messageTugasPokok').html('');
            $('#btnSaveTugasPokok').attr('disabled', true);
            var url;
            var formData = new FormData($('#formTugasPokok')[0]);
            if (save_method == 'add') {
                url = "<?= base_url() . 'simanja/analisis_jabatan/p_add_tugas_pokok' ?>";
            } else {
                url = "<?= base_url() . 'simanja/analisis_jabatan/p_update_tugas_pokok' ?>";
            }

            $.ajax({
                url: url,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function(data) {

                    if (data.status) {
                        $('#modalTugasPokok').modal('hide');
                        swal("Berhasil", "Data Berhasil Disimpan!", "success");
                        window.location.replace(base_detail_anjab + '#tab_tugas_pokok');
                        location.reload();
                    } else {
                        $('#messageTugasPokok').html('<div class="alert alert-danger">' + data.message +
                            '</div>');
                    }
                    $('#btnSaveTugasPokok').text('Simpan');
                    $('#btnSaveTugasPokok').attr('disabled', false);


                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error adding / update data');
                    $('#btnSaveTugasPokok').text('Simpan');
                    $('#btnSaveTugasPokok').attr('disabled', false);

                }
            });
        }
    }

    function deleteTugasPokok(id) {
        swal({
                title: "Hapus Data",
                text: "Apakah anda yakin akan menghapus data ini?",
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
                        url: "<?= base_url() . 'simanja/analisis_jabatan/delete_tugas_pokok/' ?>" + id,
                        type: "POST",
                        dataType: "JSON",
                        success: function(data) {
                            $('#modalTugasPokok').modal('hide');
                            swal("Berhasil", "Data Berhasil Dihapus!", "success");
                            window.location.replace(base_detail_anjab + '#tab_tugas_pokok');
                            location.reload();
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            alert('Error deleting data');
                        }
                    });
                }
            });

    }

    //Hasil Kerja
    function addHasilKerja() {
        save_method = 'add';
        $('#formHasilKerja')[0].reset();
        $('#messageHasilKerja').html('');
        $('#modalHasilKerja').modal('show');
        $('.modal-title').text('Tambah');
    }

    function editHasilKerja(id) {
        save_method = 'update';
        $('#formHasilKerja')[0].reset();
        $('#messageHasilKerja').html('');
        $('.form-group').removeClass('has-error');
        $('#hiddenHasilKerja').html('<input type="hidden" value="" name="id_hasil_kerja"/>');
        $('.help-block').empty();
        $.ajax({
            url: "<?= base_url() . 'simanja/analisis_jabatan/fetch_hasil_kerja/' ?>" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('[name="id_hasil_kerja"]').val(data.id);
                $('[name="id_uraian_tugas"]').val(data.id_uraian_tugas);
                $('[name="hasil_kerja"]').val(data.hasil_kerja);
                $('[name="jumlah_hasil"]').val(data.jumlah_hasil);
                $('[name="waktu_penyelesaian"]').val(data.waktu_penyelesaian);
                $('[name="id_satuan_hasil"]').val(data.id_satuan_hasil);
                $('#modalHasilKerja').modal('show');
                $('.modal-title').text('Ubah');

            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Gagal mendapatkan data");
            }
        });

    }

    function simpanHasilKerja() {
        var hasil_kerja = $('[name="hasil_kerja"]').val();
        var jumlah_hasil = $('[name="jumlah_hasil"]').val();
        var waktu_penyelesaian = $('[name="waktu_penyelesaian"]').val();

        if (!hasil_kerja) {
            alert('Hasil Kerja harus diisi')
        }

        if (!jumlah_hasil) {
            alert('Jumlah hasil harus diisi')
        }

        if (!waktu_penyelesaian) {
            alert('Waktu penyelesaian per Satuan Hasil Kerja harus diisi')
        }

        if (hasil_kerja !== '' || jumlah_hasil !== '' || waktu_penyelesaian !== '') {
            $('#btnSaveHasilKerja').text('Menyimpan...');
            $('#messageHasilKerja').html('');
            $('#btnSaveHasilKerja').attr('disabled', true);
            var url;
            var formData = new FormData($('#formHasilKerja')[0]);
            if (save_method == 'add') {
                url = "<?= base_url() . 'simanja/analisis_jabatan/p_add_hasil_kerja' ?>";
            } else {
                url = "<?= base_url() . 'simanja/analisis_jabatan/p_update_hasil_kerja' ?>";
            }

            $.ajax({
                url: url,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function(data) {

                    if (data.status) {
                        $('#modalHasilKerja').modal('hide');
                        swal("Berhasil", "Data Berhasil Disimpan!", "success");
                        window.location.replace(base_detail_anjab + '#tab_hasil_kerja');
                        location.reload();
                    } else {
                        $('#messageHasilKerja').html('<div class="alert alert-danger">' + data.message +
                            '</div>');
                    }
                    $('#btnSaveHasilKerja').text('Simpan');
                    $('#btnSaveHasilKerja').attr('disabled', false);


                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error adding / update data');
                    $('#btnSaveHasilKerja').text('Simpan');
                    $('#btnSaveHasilKerja').attr('disabled', false);

                }
            });
        } else {
            alert('Isi semua form !')
        }
    }

    function deleteHasilKerja(id) {
        swal({
                title: "Hapus Data",
                text: "Apakah anda yakin akan menghapus data ini?",
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
                        url: "<?= base_url() . 'simanja/analisis_jabatan/delete_hasil_kerja/' ?>" + id,
                        type: "POST",
                        dataType: "JSON",
                        success: function(data) {
                            $('#modalHasilKerja').modal('hide');
                            swal("Berhasil", "Data Berhasil Dihapus!", "success");
                            window.location.replace(base_detail_anjab + '#tab_hasil_kerja');
                            location.reload();
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            alert('Error deleting data');
                        }
                    });
                }
            });

    }

    //Bahan Kerja
    function addBahanKerja() {
        save_method = 'add';
        $('#formBahanKerja')[0].reset();
        $('#messageBahanKerja').html('');
        $('#modalBahanKerja').modal('show');
        $('.modal-title').text('Tambah');
    }

    function editBahanKerja(id) {
        save_method = 'update';
        $('#formBahanKerja')[0].reset();
        $('#messageBahanKerja').html('');
        $('.form-group').removeClass('has-error');
        $('#hiddenBahanKerja').html('<input type="hidden" value="" name="id_bahan_kerja"/>');
        $('.help-block').empty();
        $.ajax({
            url: "<?= base_url() . 'simanja/analisis_jabatan/fetch_bahan_kerja/' ?>" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('[name="id_bahan_kerja"]').val(data.id);
                $('[name="bahan_kerja"]').val(data.bahan_kerja);
                $('[name="penggunaan_dalam_tugas"]').val(data.penggunaan_dalam_tugas);
                $('#modalBahanKerja').modal('show');
                $('.modal-title').text('Ubah');

            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Gagal mendapatkan data");
            }
        });

    }

    function simpanBahanKerja() {
        var bahan_kerja = $('[name="bahan_kerja"]').val();

        if (!bahan_kerja) {
            alert('Hasil Kerja Jabatan harus diisi')
        }

        if (bahan_kerja !== '') {
            $('#btnSaveBahanKerja').text('Menyimpan...');
            $('#messageBahanKerja').html('');
            $('#btnSaveBahanKerja').attr('disabled', true);
            var url;
            var formData = new FormData($('#formBahanKerja')[0]);
            if (save_method == 'add') {
                url = "<?= base_url() . 'simanja/analisis_jabatan/p_add_bahan_kerja' ?>";
            } else {
                url = "<?= base_url() . 'simanja/analisis_jabatan/p_update_bahan_kerja' ?>";
            }

            $.ajax({
                url: url,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function(data) {

                    if (data.status) {
                        $('#modalBahanKerja').modal('hide');
                        swal("Berhasil", "Data Berhasil Disimpan!", "success");
                        window.location.replace(base_detail_anjab + '#tab_bahan_kerja');
                        location.reload()
                    } else {
                        $('#messageBahanKerja').html('<div class="alert alert-danger">' + data.message +
                            '</div>');
                    }
                    $('#btnSaveBahanKerja').text('Simpan');
                    $('#btnSaveBahanKerja').attr('disabled', false);


                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error adding / update data');
                    $('#btnSaveBahanKerja').text('Simpan');
                    $('#btnSaveBahanKerja').attr('disabled', false);

                }
            });
        }
    }

    function deleteBahanKerja(id) {
        swal({
                title: "Hapus Data",
                text: "Apakah anda yakin akan menghapus data ini?",
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
                        url: "<?= base_url() . 'simanja/analisis_jabatan/delete_bahan_kerja/' ?>" + id,
                        type: "POST",
                        dataType: "JSON",
                        success: function(data) {
                            $('#modalBahanKerja').modal('hide');
                            swal("Berhasil", "Data Berhasil Dihapus!", "success");
                            window.location.replace(base_detail_anjab + '#tab_bahan_kerja');
                            location.reload()
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            alert('Error deleting data');
                        }
                    });
                }
            });

    }

    //Perangkat Kerja
    function addPerangkatKerja() {
        save_method = 'add';
        $('#formPerangkatKerja')[0].reset();
        $('#messagePerangkatKerja').html('');
        $('#modalPerangkatKerja').modal('show');
        $('.modal-title').text('Tambah');
    }

    function editPerangkatKerja(id) {
        save_method = 'update';
        $('#formPerangkatKerja')[0].reset();
        $('#messagePerangkatKerja').html('');
        $('.form-group').removeClass('has-error');
        $('#hiddenPerangkatKerja').html('<input type="hidden" value="" name="id_perangkat_kerja"/>');
        $('.help-block').empty();
        $.ajax({
            url: "<?= base_url() . 'simanja/analisis_jabatan/fetch_perangkat_kerja/' ?>" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('[name="id_perangkat_kerja"]').val(data.id);
                $('[name="perangkat_kerja"]').val(data.perangkat_kerja);
                $('[name="penggunaan_dalam_tugas"]').val(data.penggunaan_dalam_tugas);
                $('#modalPerangkatKerja').modal('show');
                $('.modal-title').text('Ubah');

            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Gagal mendapatkan data");
            }
        });

    }

    function simpanPerangkatKerja() {
        var perangkat_kerja = $('[name="perangkat_kerja"]').val();

        if (!perangkat_kerja) {
            alert('Perangkat Kerja harus diisi')
        }

        if (perangkat_kerja !== '') {
            $('#btnSavePerangkatKerja').text('Menyimpan...');
            $('#messagePerangkatKerja').html('');
            $('#btnSavePerangkatKerja').attr('disabled', true);
            var url;
            var formData = new FormData($('#formPerangkatKerja')[0]);
            if (save_method == 'add') {
                url = "<?= base_url() . 'simanja/analisis_jabatan/p_add_perangkat_kerja' ?>";
            } else {
                url = "<?= base_url() . 'simanja/analisis_jabatan/p_update_perangkat_kerja' ?>";
            }

            $.ajax({
                url: url,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function(data) {

                    if (data.status) {
                        $('#modalPerangkatKerja').modal('hide');
                        swal("Berhasil", "Data Berhasil Disimpan!", "success");
                        window.location.replace(base_detail_anjab + '#tab_perangkat_kerja');
                        location.reload()
                    } else {
                        $('#messagePerangkatKerja').html('<div class="alert alert-danger">' + data.message +
                            '</div>');
                    }
                    $('#btnSavePerangkatKerja').text('Simpan');
                    $('#btnSavePerangkatKerja').attr('disabled', false);


                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error adding / update data');
                    $('#btnSavePerangkatKerja').text('Simpan');
                    $('#btnSavePerangkatKerja').attr('disabled', false);

                }
            });
        }
    }

    function deletePerangkatKerja(id) {
        swal({
                title: "Hapus Data",
                text: "Apakah anda yakin akan menghapus data ini?",
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
                        url: "<?= base_url() . 'simanja/analisis_jabatan/delete_perangkat_kerja/' ?>" + id,
                        type: "POST",
                        dataType: "JSON",
                        success: function(data) {
                            $('#modalPerangkatKerja').modal('hide');
                            swal("Berhasil", "Data Berhasil Dihapus!", "success");
                            window.location.replace(base_detail_anjab + '#tab_perangkat_kerja');
                            location.reload()
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            alert('Error deleting data');
                        }
                    });
                }
            });

    }

    //Tanggung Jawab
    function addTanggungJawab() {
        save_method = 'add';
        $('#formTanggungJawab')[0].reset();
        $('#messageTanggungJawab').html('');
        $('#modalTanggungJawab').modal('show');
        $('.modal-title').text('Tambah');
    }

    function editTanggungJawab(id) {
        save_method = 'update';
        $('#formTanggungJawab')[0].reset();
        $('#messageTanggungJawab').html('');
        $('.form-group').removeClass('has-error');
        $('#hiddenTanggungJawab').html('<input type="hidden" value="" name="id_tanggung_jawab"/>');
        $('.help-block').empty();
        $.ajax({
            url: "<?= base_url() . 'simanja/analisis_jabatan/fetch_tanggung_jawab/' ?>" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('[name="id_tanggung_jawab"]').val(data.id);
                $('[name="tanggung_jawab"]').val(data.tanggung_jawab);
                $('#modalTanggungJawab').modal('show');
                $('.modal-title').text('Ubah');

            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Gagal mendapatkan data");
            }
        });

    }

    function simpanTanggungJawab() {
        var tanggung_jawab = $('[name="tanggung_jawab"]').val();

        if (!tanggung_jawab) {
            alert('Tanggung Jawab harus diisi')
        }

        if (tanggung_jawab !== '') {
            $('#btnSaveTanggungJawab').text('Menyimpan...');
            $('#messageTanggungJawab').html('');
            $('#btnSaveTanggungJawab').attr('disabled', true);
            var url;
            var formData = new FormData($('#formTanggungJawab')[0]);
            if (save_method == 'add') {
                url = "<?= base_url() . 'simanja/analisis_jabatan/p_add_tanggung_jawab' ?>";
            } else {
                url = "<?= base_url() . 'simanja/analisis_jabatan/p_update_tanggung_jawab' ?>";
            }

            $.ajax({
                url: url,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function(data) {

                    if (data.status) {
                        $('#modalTanggungJawab').modal('hide');
                        swal("Berhasil", "Data Berhasil Disimpan!", "success");
                        window.location.replace(base_detail_anjab + '#tab_tanggung_jawab');
                        location.reload()
                    } else {
                        $('#messageTanggungJawab').html('<div class="alert alert-danger">' + data.message +
                            '</div>');
                    }
                    $('#btnSaveTanggungJawab').text('Simpan');
                    $('#btnSaveTanggungJawab').attr('disabled', false);


                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error adding / update data');
                    $('#btnSaveTanggungJawab').text('Simpan');
                    $('#btnSaveTanggungJawab').attr('disabled', false);

                }
            });
        }
    }

    function deleteTanggungJawab(id) {
        swal({
                title: "Hapus Data",
                text: "Apakah anda yakin akan menghapus data ini?",
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
                        url: "<?= base_url() . 'simanja/analisis_jabatan/delete_tanggung_jawab/' ?>" + id,
                        type: "POST",
                        dataType: "JSON",
                        success: function(data) {
                            $('#modalTanggungJawab').modal('hide');
                            swal("Berhasil", "Data Berhasil Dihapus!", "success");
                            window.location.replace(base_detail_anjab + '#tab_tanggung_jawab');
                            location.reload()
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            alert('Error deleting data');
                        }
                    });
                }
            });

    }

    //Wewenang
    function addWewenang() {
        save_method = 'add';
        $('#formWewenang')[0].reset();
        $('#messageWewenang').html('');
        $('#modalWewenang').modal('show');
        $('.modal-title').text('Tambah');
    }

    function editWewenang(id) {
        save_method = 'update';
        $('#formWewenang')[0].reset();
        $('#messageWewenang').html('');
        $('.form-group').removeClass('has-error');
        $('#hiddenWewenang').html('<input type="hidden" value="" name="id_wewenang"/>');
        $('.help-block').empty();
        $.ajax({
            url: "<?= base_url() . 'simanja/analisis_jabatan/fetch_wewenang/' ?>" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('[name="id_wewenang"]').val(data.id);
                $('[name="wewenang"]').val(data.wewenang);
                $('#modalWewenang').modal('show');
                $('.modal-title').text('Ubah');

            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Gagal mendapatkan data");
            }
        });

    }

    function simpanWewenang() {
        var wewenang = $('[name="wewenang"]').val();

        if (!wewenang) {
            alert('Wewenang harus diisi')
        }

        if (wewenang !== '') {
            $('#btnSaveWewenang').text('Menyimpan...');
            $('#messageWewenang').html('');
            $('#btnSaveWewenang').attr('disabled', true);
            var url;
            var formData = new FormData($('#formWewenang')[0]);
            if (save_method == 'add') {
                url = "<?= base_url() . 'simanja/analisis_jabatan/p_add_wewenang' ?>";
            } else {
                url = "<?= base_url() . 'simanja/analisis_jabatan/p_update_wewenang' ?>";
            }

            $.ajax({
                url: url,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function(data) {

                    if (data.status) {
                        $('#modalWewenang').modal('hide');
                        swal("Berhasil", "Data Berhasil Disimpan!", "success");
                        window.location.replace(base_detail_anjab + '#tab_wewenang');
                        location.reload()
                    } else {
                        $('#messageWewenang').html('<div class="alert alert-danger">' + data.message +
                            '</div>');
                    }
                    $('#btnSaveWewenang').text('Simpan');
                    $('#btnSaveWewenang').attr('disabled', false);


                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error adding / update data');
                    $('#btnSaveWewenang').text('Simpan');
                    $('#btnSaveWewenang').attr('disabled', false);

                }
            });
        }
    }

    function deleteWewenang(id) {
        swal({
                title: "Hapus Data",
                text: "Apakah anda yakin akan menghapus data ini?",
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
                        url: "<?= base_url() . 'simanja/analisis_jabatan/delete_wewenang/' ?>" + id,
                        type: "POST",
                        dataType: "JSON",
                        success: function(data) {
                            $('#modalWewenang').modal('hide');
                            swal("Berhasil", "Data Berhasil Dihapus!", "success");
                            window.location.replace(base_detail_anjab + '#tab_wewenang');
                            location.reload()
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            alert('Error deleting data');
                        }
                    });
                }
            });

    }

    //KorelasiJabatan
    function addKorelasiJabatan() {
        save_method = 'add';
        $('#formKorelasiJabatan')[0].reset();
        $('#messageKorelasiJabatan').html('');
        $('#modalKorelasiJabatan').modal('show');
        $('.modal-title').text('Tambah');
    }

    function editKorelasiJabatan(id) {
        save_method = 'update';
        $('#formKorelasiJabatan')[0].reset();
        $('#messageKorelasiJabatan').html('');
        $('.form-group').removeClass('has-error');
        $('#hiddenKorelasiJabatan').html('<input type="hidden" value="" name="id_korelasi_jabatan"/>');
        $('.help-block').empty();
        $.ajax({
            url: "<?= base_url() . 'simanja/analisis_jabatan/fetch_korelasi_jabatan/' ?>" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('[name="id_korelasi_jabatan"]').val(data.id);
                $('[name="jabatan"]').val(data.jabatan);
                $('[name="unit_kerja"]').val(data.unit_kerja);
                $('[name="hubungan_tugas"]').val(data.hubungan_tugas);
                $('#modalKorelasiJabatan').modal('show');
                $('.modal-title').text('Ubah');

            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Gagal mendapatkan data");
            }
        });
    }

    function simpanKorelasiJabatan() {
        var jabatan = $('[name="jabatan"]').val();
        var unit_kerja = $('[name="unit_kerja"]').val();
        var hubungan_tugas = $('[name="hubungan_tugas"]').val();

        if (!jabatan) {
            alert('Jabatan harus diisi')
        }

        if (!unit_kerja) {
            alert('Unit Kerja harus diisi')
        }

        if (!hubungan_tugas) {
            alert('Hubungan Tugas harus diisi')
        }

        if (jabatan !== '' && unit_kerja !== '' & hubungan_tugas !== '') {
            $('#btnSaveKorelasiJabatan').text('Menyimpan...');
            $('#messageKorelasiJabatan').html('');
            $('#btnSaveKorelasiJabatan').attr('disabled', true);
            var url;
            var formData = new FormData($('#formKorelasiJabatan')[0]);
            if (save_method == 'add') {
                url = "<?= base_url() . 'simanja/analisis_jabatan/p_add_korelasi_jabatan' ?>";
            } else {
                url = "<?= base_url() . 'simanja/analisis_jabatan/p_update_korelasi_jabatan' ?>";
            }

            $.ajax({
                url: url,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function(data) {

                    if (data.status) {
                        $('#modalKorelasiJabatan').modal('hide');
                        swal("Berhasil", "Data Berhasil Disimpan!", "success");
                        window.location.replace(base_detail_anjab + '#tab_korelasi_jabatan');
                        location.reload()
                    } else {
                        $('#messageKorelasiJabatan').html('<div class="alert alert-danger">' + data
                            .message + '</div>');
                    }
                    $('#btnSaveKorelasiJabatan').text('Simpan');
                    $('#btnSaveKorelasiJabatan').attr('disabled', false);


                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error adding / update data');
                    $('#btnSaveKorelasiJabatan').text('Simpan');
                    $('#btnSaveKorelasiJabatan').attr('disabled', false);

                }
            });
        }
    }

    function deleteKorelasiJabatan(id) {
        swal({
                title: "Hapus Data",
                text: "Apakah anda yakin akan menghapus data ini?",
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
                        url: "<?= base_url() . 'simanja/analisis_jabatan/delete_korelasi_jabatan/' ?>" + id,
                        type: "POST",
                        dataType: "JSON",
                        success: function(data) {
                            $('#modalKorelasiJabatan').modal('hide');
                            swal("Berhasil", "Data Berhasil Dihapus!", "success");
                            window.location.replace(base_detail_anjab + '#tab_korelasi_jabatan');
                            location.reload()
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            alert('Error deleting data');
                        }
                    });
                }
            });
    }

    //KondisiLingkunganKerja
    function addKondisiLingkunganKerja() {
        save_method = 'add';
        $('#formKondisiLingkunganKerja')[0].reset();
        $('#messageKondisiLingkunganKerja').html('');
        $('#modalKondisiLingkunganKerja').modal('show');
        $('.modal-title').text('Tambah');
    }

    function editKondisiLingkunganKerja(id) {
        save_method = 'update';
        $('#formKondisiLingkunganKerja')[0].reset();
        $('#messageKondisiLingkunganKerja').html('');
        $('.form-group').removeClass('has-error');
        $('#hiddenKondisiLingkunganKerja').html('<input type="hidden" value="" name="id_kondisi_lingkungan_kerja"/>');
        $('.help-block').empty();
        $.ajax({
            url: "<?= base_url() . 'simanja/analisis_jabatan/fetch_kondisi_lingkungan_kerja/' ?>" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('[name="id_kondisi_lingkungan_kerja"]').val(data.id);
                $('[name="tempat_kerja"]').val(data.tempat_kerja);
                $('[name="suhu"]').val(data.suhu);
                $('[name="udara"]').val(data.udara);
                $('[name="keadaan_ruangan"]').val(data.keadaan_ruangan);
                $('[name="letak"]').val(data.letak);
                $('[name="penerangan"]').val(data.penerangan);
                $('[name="suara"]').val(data.suara);
                $('[name="keadaan_tempat_kerja"]').val(data.keadaan_tempat_kerja);
                $('[name="getaran"]').val(data.getaran);
                $('#modalKondisiLingkunganKerja').modal('show');
                $('.modal-title').text('Ubah');

            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Gagal mendapatkan data");
            }
        });
    }

    function simpanKondisiLingkunganKerja() {
        var tempat_kerja = $('[name="tempat_kerja"]').val();
        var suhu = $('[name="suhu"]').val();
        var udara = $('[name="udara"]').val();
        var keadaan_ruangan = $('[name="keadaan_ruangan"]').val();
        var letak = $('[name="letak"]').val();
        var penerangan = $('[name="penerangan"]').val();
        var suara = $('[name="suara"]').val();
        var keadaan_tempat_kerja = $('[name="keadaan_tempat_kerja"]').val();
        var getaran = $('[name="getaran"]').val();

        if (!tempat_kerja) {
            alert('Tempat Kerja harus diisi')
        }

        if (!suhu) {
            alert('Suhu harus diisi')
        }

        if (!udara) {
            alert('Udara harus diisi')
        }

        if (!keadaan_ruangan) {
            alert('Keadaan ruangan harus diisi')
        }

        if (!letak) {
            alert('Letak harus diisi')
        }

        if (!penerangan) {
            alert('penerangan harus diisi')
        }

        if (!suara) {
            alert('Suara harus diisi')
        }

        if (!keadaan_tempat_kerja) {
            alert('Keadaan tempat kerja harus diisi')
        }

        if (!getaran) {
            alert('Getaran harus diisi')
        }

        if (tempat_kerja !== '' && suhu !== '' & udara !== '' && keadaan_ruangan !== '' && letak !== '' &&
            penerangan !== '' &&
            suara !== '' && keadaan_tempat_kerja !== '' && getaran !== '') {
            $('#btnSaveKondisiLingkunganKerja').text('Menyimpan...');
            $('#messageKondisiLingkunganKerja').html('');
            $('#btnSaveKondisiLingkunganKerja').attr('disabled', true);
            var url;
            var formData = new FormData($('#formKondisiLingkunganKerja')[0]);
            if (save_method == 'add') {
                url = "<?= base_url() . 'simanja/analisis_jabatan/p_add_kondisi_lingkungan_kerja' ?>";
            } else {
                url = "<?= base_url() . 'simanja/analisis_jabatan/p_update_kondisi_lingkungan_kerja' ?>";
            }

            $.ajax({
                url: url,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function(data) {

                    if (data.status) {
                        $('#modalKondisiLingkunganKerja').modal('hide');
                        swal("Berhasil", "Data Berhasil Disimpan!", "success");
                        window.location.replace(base_detail_anjab + '#tab_kondisi_lingkungan_kerja');
                        location.reload()
                    } else {
                        $('#messageKondisiLingkunganKerja').html('<div class="alert alert-danger">' + data
                            .message + '</div>');
                    }
                    $('#btnSaveKondisiLingkunganKerja').text('Simpan');
                    $('#btnSaveKondisiLingkunganKerja').attr('disabled', false);


                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error adding / update data');
                    $('#btnSaveKondisiLingkunganKerja').text('Simpan');
                    $('#btnSaveKondisiLingkunganKerja').attr('disabled', false);

                }
            });
        }
    }

    function deleteKondisiLingkunganKerja(id) {
        swal({
                title: "Hapus Data",
                text: "Apakah anda yakin akan menghapus data ini?",
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
                        url: "<?= base_url() . 'simanja/analisis_jabatan/delete_kondisi_lingkungan_kerja/' ?>" +
                            id,
                        type: "POST",
                        dataType: "JSON",
                        success: function(data) {
                            $('#modalKondisiLingkunganKerja').modal('hide');
                            swal("Berhasil", "Data Berhasil Dihapus!", "success");
                            window.location.replace(base_detail_anjab +
                                '#tab_kondisi_lingkungan_kerja');
                            location.reload()
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            alert('Error deleting data');
                        }
                    });
                }
            });
    }

    //RisikoBahaya
    function addRisikoBahaya() {
        save_method = 'add';
        $('#formRisikoBahaya')[0].reset();
        $('#messageRisikoBahaya').html('');
        $('#modalRisikoBahaya').modal('show');
        $('.modal-title').text('Tambah');
    }

    function editRisikoBahaya(id) {
        save_method = 'update';
        $('#formRisikoBahaya')[0].reset();
        $('#messageRisikoBahaya').html('');
        $('.form-group').removeClass('has-error');
        $('#hiddenRisikoBahaya').html('<input type="hidden" value="" name="id_risiko_bahaya"/>');
        $('.help-block').empty();
        $.ajax({
            url: "<?= base_url() . 'simanja/analisis_jabatan/fetch_risiko_bahaya/' ?>" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('[name="id_risiko_bahaya"]').val(data.id);
                $('[name="risiko"]').val(data.risiko);
                $('[name="penyebab"]').val(data.penyebab);
                $('#modalRisikoBahaya').modal('show');
                $('.modal-title').text('Ubah');

            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Gagal mendapatkan data");
            }
        });
    }

    function simpanRisikoBahaya() {
        var risiko = $('[name="risiko"]').val();
        var penyebab = $('[name="penyebab"]').val();

        if (!risiko) {
            alert('Risiko harus diisi')
        }

        if (!penyebab) {
            alert('Penyebab harus diisi')
        }

        if (risiko !== '' && penyebab !== '') {
            $('#btnSaveRisikoBahaya').text('Menyimpan...');
            $('#messageRisikoBahaya').html('');
            $('#btnSaveRisikoBahaya').attr('disabled', true);
            var url;
            var formData = new FormData($('#formRisikoBahaya')[0]);
            if (save_method == 'add') {
                url = "<?= base_url() . 'simanja/analisis_jabatan/p_add_risiko_bahaya' ?>";
            } else {
                url = "<?= base_url() . 'simanja/analisis_jabatan/p_update_risiko_bahaya' ?>";
            }

            $.ajax({
                url: url,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function(data) {

                    if (data.status) {
                        $('#modalRisikoBahaya').modal('hide');
                        swal("Berhasil", "Data Berhasil Disimpan!", "success");
                        window.location.replace(base_detail_anjab + '#tab_risiko_bahaya');
                        location.reload()
                    } else {
                        $('#messageRisikoBahaya').html('<div class="alert alert-danger">' + data.message +
                            '</div>');
                    }
                    $('#btnSaveRisikoBahaya').text('Simpan');
                    $('#btnSaveRisikoBahaya').attr('disabled', false);


                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error adding / update data');
                    $('#btnSaveRisikoBahaya').text('Simpan');
                    $('#btnSaveRisikoBahaya').attr('disabled', false);

                }
            });
        }
    }

    function deleteRisikoBahaya(id) {
        swal({
                title: "Hapus Data",
                text: "Apakah anda yakin akan menghapus data ini?",
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
                        url: "<?= base_url() . 'simanja/analisis_jabatan/delete_risiko_bahaya/' ?>" + id,
                        type: "POST",
                        dataType: "JSON",
                        success: function(data) {
                            $('#modalRisikoBahaya').modal('hide');
                            swal("Berhasil", "Data Berhasil Dihapus!", "success");
                            window.location.replace(base_detail_anjab + '#tab_risiko_bahaya');
                            location.reload()
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            alert('Error deleting data');
                        }
                    });
                }
            });
    }

    //Syarat
    //Keterampilan Kerja
    function addKeterampilanKerja(id) {
        save_method = 'add';
        $('#formKeterampilanKerja')[0].reset();
        $('#messageKeterampilanKerja').html('');
        $('#modalKeterampilanKerja').modal('show');
        $('.modal-title').text('Manage');
        $.ajax({
            url: "<?= base_url() . 'simanja/analisis_jabatan/fetch_syarat_keterampilan_kerja/' ?>" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                let selected = []
                data.forEach((v) => {
                    selected.push(v.id)
                })
                $('#keterampilan-kerja-select2').val(selected);
                $('#keterampilan-kerja-select2').trigger('change');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Gagal mendapatkan data");
            }
        });
    }

    function simpanKeterampilanKerja() {
        var listed = $('[name="listed[]"]').val();

        if (listed == null) {
            alert('Keterampilan kerja harus diisi')
        }

        if (listed !== '') {
            $('#btnSaveKeterampilanKerja').text('Menyimpan...');
            $('#messageKeterampilanKerja').html('');
            $('#btnSaveKeterampilanKerja').attr('disabled', true);
            var url;
            var formData = new FormData($('#formKeterampilanKerja')[0]);
            if (save_method == 'add') {
                url = "<?= base_url() . 'simanja/analisis_jabatan/p_add_syarat_keterampilan_kerja' ?>";
            } else {
                url = "<?= base_url() . 'simanja/analisis_jabatan/p_update_syarat_keterampilan_kerja' ?>";
            }

            $.ajax({
                url: url,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function(data) {

                    if (data.status) {
                        $('#modalKeterampilanKerja').modal('hide');
                        swal("Berhasil", "Data Berhasil Disimpan!", "success");
                        window.location.replace(base_detail_anjab + '#tab_syarat_jabatan');
                        location.reload()
                    } else {
                        $('#messageKeterampilanKerja').html('<div class="alert alert-danger">' + data
                            .message + '</div>');
                    }
                    $('#btnSaveKeterampilanKerja').text('Simpan');
                    $('#btnSaveKeterampilanKerja').attr('disabled', false);


                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error adding / update data');
                    $('#btnSaveKeterampilanKerja').text('Simpan');
                    $('#btnSaveKeterampilanKerja').attr('disabled', false);

                }
            });
        }
    }

    //Bakat Kerja
    function addBakatKerja(id) {
        save_method = 'add';
        $('#formBakatKerja')[0].reset();
        $('#messageBakatKerja').html('');
        $('#modalBakatKerja').modal('show');
        $('.modal-title').text('Manage');
        $.ajax({
            url: "<?= base_url() . 'simanja/analisis_jabatan/fetch_syarat_bakat_kerja/' ?>" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                let selected = []
                data.forEach((v) => {
                    selected.push(v.id)
                })
                $('#bakat-kerja-select2').val(selected);
                $('#bakat-kerja-select2').trigger('change');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Gagal mendapatkan data");
            }
        });
    }

    function simpanBakatKerja() {
        var listed = $('[name="listed[]"]').val();

        if (listed == null) {
            alert('Bakat kerja harus diisi')
        }

        if (listed !== '') {
            $('#btnSaveBakatKerja').text('Menyimpan...');
            $('#messageBakatKerja').html('');
            $('#btnSaveBakatKerja').attr('disabled', true);
            var url;
            var formData = new FormData($('#formBakatKerja')[0]);
            if (save_method == 'add') {
                url = "<?= base_url() . 'simanja/analisis_jabatan/p_add_syarat_bakat_kerja' ?>";
            } else {
                url = "<?= base_url() . 'simanja/analisis_jabatan/p_update_syarat_bakat_kerja' ?>";
            }

            $.ajax({
                url: url,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function(data) {

                    if (data.status) {
                        $('#modalBakatKerja').modal('hide');
                        swal("Berhasil", "Data Berhasil Disimpan!", "success");
                        window.location.replace(base_detail_anjab + '#tab_syarat_jabatan');
                        location.reload()
                    } else {
                        $('#messageBakatKerja').html('<div class="alert alert-danger">' + data.message +
                            '</div>');
                    }
                    $('#btnSaveBakatKerja').text('Simpan');
                    $('#btnSaveBakatKerja').attr('disabled', false);


                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error adding / update data');
                    $('#btnSaveBakatKerja').text('Simpan');
                    $('#btnSaveBakatKerja').attr('disabled', false);

                }
            });
        }
    }

    //Temperamen Kerja
    function addTemperamenKerja(id) {
        save_method = 'add';
        $('#formTemperamenKerja')[0].reset();
        $('#messageTemperamenKerja').html('');
        $('#modalTemperamenKerja').modal('show');
        $('.modal-title').text('Manage');
        $.ajax({
            url: "<?= base_url() . 'simanja/analisis_jabatan/fetch_syarat_temperamen_kerja/' ?>" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                let selected = []
                data.forEach((v) => {
                    selected.push(v.id)
                })
                console.log(data)
                $('#temperamen-kerja-select2').val(selected);
                $('#temperamen-kerja-select2').trigger('change');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Gagal mendapatkan data");
            }
        });
    }

    function simpanTemperamenKerja() {
        var listed = $('[name="listed[]"]').val();

        if (listed == null) {
            alert('Temperamen kerja harus diisi')
        }

        if (listed !== '') {
            $('#btnSaveTemperamenKerja').text('Menyimpan...');
            $('#messageTemperamenKerja').html('');
            $('#btnSaveTemperamenKerja').attr('disabled', true);
            var url;
            var formData = new FormData($('#formTemperamenKerja')[0]);
            if (save_method == 'add') {
                url = "<?= base_url() . 'simanja/analisis_jabatan/p_add_syarat_temperamen_kerja' ?>";
            } else {
                url = "<?= base_url() . 'simanja/analisis_jabatan/p_update_syarat_temperamen_kerja' ?>";
            }

            $.ajax({
                url: url,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function(data) {

                    if (data.status) {
                        $('#modalTemperamenKerja').modal('hide');
                        swal("Berhasil", "Data Berhasil Disimpan!", "success");
                        window.location.replace(base_detail_anjab + '#tab_syarat_jabatan');
                        location.reload()
                    } else {
                        $('#messageTemperamenKerja').html('<div class="alert alert-danger">' + data
                            .message + '</div>');
                    }
                    $('#btnSaveTemperamenKerja').text('Simpan');
                    $('#btnSaveTemperamenKerja').attr('disabled', false);


                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error adding / update data');
                    $('#btnSaveTemperamenKerja').text('Simpan');
                    $('#btnSaveTemperamenKerja').attr('disabled', false);

                }
            });
        }
    }

    //Minat Kerja
    function addMinatKerja(id) {
        save_method = 'add';
        $('#formMinatKerja')[0].reset();
        $('#messageMinatKerja').html('');
        $('#modalMinatKerja').modal('show');
        $('.modal-title').text('Manage');
        $.ajax({
            url: "<?= base_url() . 'simanja/analisis_jabatan/fetch_syarat_minat_kerja/' ?>" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                let selected = []
                data.forEach((v) => {
                    selected.push(v.id)
                })
                $('#minat-kerja-select2').val(selected);
                $('#minat-kerja-select2').trigger('change');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Gagal mendapatkan data");
            }
        });
    }

    function simpanMinatKerja() {
        var listed = $('[name="listed[]"]').val();

        if (listed === null) {
            alert('Minat kerja harus diisi')
        }

        if (listed !== '') {
            $('#btnSaveMinatKerja').text('Menyimpan...');
            $('#messageMinatKerja').html('');
            $('#btnSaveMinatKerja').attr('disabled', true);
            var url;
            var formData = new FormData($('#formMinatKerja')[0]);
            if (save_method == 'add') {
                url = "<?= base_url() . 'simanja/analisis_jabatan/p_add_syarat_minat_kerja' ?>";
            } else {
                url = "<?= base_url() . 'simanja/analisis_jabatan/p_update_syarat_minat_kerja' ?>";
            }

            $.ajax({
                url: url,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function(data) {

                    if (data.status) {
                        $('#modalMinatKerja').modal('hide');
                        swal("Berhasil", "Data Berhasil Disimpan!", "success");
                        window.location.replace(base_detail_anjab + '#tab_syarat_jabatan');
                        location.reload()
                    } else {
                        $('#messageMinatKerja').html('<div class="alert alert-danger">' + data.message +
                            '</div>');
                    }
                    $('#btnSaveMinatKerja').text('Simpan');
                    $('#btnSaveMinatKerja').attr('disabled', false);


                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error adding / update data');
                    $('#btnSaveMinatKerja').text('Simpan');
                    $('#btnSaveMinatKerja').attr('disabled', false);

                }
            });
        }
    }

    //Upaya Fisik
    function addUpayaFisik(id) {
        save_method = 'add';
        $('#formUpayaFisik')[0].reset();
        $('#messageUpayaFisik').html('');
        $('#modalUpayaFisik').modal('show');
        $('.modal-title').text('Manage');
        $.ajax({
            url: "<?= base_url() . 'simanja/analisis_jabatan/fetch_syarat_upaya_fisik/' ?>" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                let selected = []
                data.forEach((v) => {
                    selected.push(v.id)
                })
                $('#upaya-fisik-select2').val(selected);
                $('#upaya-fisik-select2').trigger('change');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Gagal mendapatkan data");
            }
        });
    }

    function simpanUpayaFisik() {
        var listed = $('[name="listed[]"]').val();

        if (listed == null) {
            alert('Upaya Fisik harus diisi')
        }

        if (listed !== '') {
            $('#btnSaveUpayaFisik').text('Menyimpan...');
            $('#messageUpayaFisik').html('');
            $('#btnSaveUpayaFisik').attr('disabled', true);
            var url;
            var formData = new FormData($('#formUpayaFisik')[0]);
            if (save_method == 'add') {
                url = "<?= base_url() . 'simanja/analisis_jabatan/p_add_syarat_upaya_fisik' ?>";
            } else {
                url = "<?= base_url() . 'simanja/analisis_jabatan/p_update_syarat_upaya_fisik' ?>";
            }

            $.ajax({
                url: url,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function(data) {

                    if (data.status) {
                        $('#modalUpayaFisik').modal('hide');
                        swal("Berhasil", "Data Berhasil Disimpan!", "success");
                        window.location.replace(base_detail_anjab + '#tab_syarat_jabatan');
                        location.reload()
                    } else {
                        $('#messageUpayaFisik').html('<div class="alert alert-danger">' + data.message +
                            '</div>');
                    }
                    $('#btnSaveUpayaFisik').text('Simpan');
                    $('#btnSaveUpayaFisik').attr('disabled', false);


                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error adding / update data');
                    $('#btnSaveUpayaFisik').text('Simpan');
                    $('#btnSaveUpayaFisik').attr('disabled', false);

                }
            });
        }
    }

    //KondisiFisik
    function addKondisiFisik() {
        save_method = 'add';
        $('#formKondisiFisik')[0].reset();
        $('#messageKondisiFisik').html('');
        $('#modalKondisiFisik').modal('show');
        $('.modal-title').text('Tambah');
    }

    function editKondisiFisik(id) {
        save_method = 'update';
        $('#formKondisiFisik')[0].reset();
        $('#messageKondisiFisik').html('');
        $('.form-group').removeClass('has-error');
        $('#hiddenKondisiFisik').html('<input type="hidden" value="" name="id_syarat_kondisi_fisik"/>');
        $('.help-block').empty();
        $.ajax({
            url: "<?= base_url() . 'simanja/analisis_jabatan/fetch_syarat_kondisi_fisik/' ?>" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('[name="id_syarat_kondisi_fisik"]').val(data.id);
                $('[name="tempat_kerja"]').val(data.tempat_kerja);
                $('[name="suhu"]').val(data.suhu);
                $('[name="udara"]').val(data.udara);
                $('[name="keadaan_ruangan"]').val(data.keadaan_ruangan);
                $('[name="letak"]').val(data.letak);
                $('[name="penerangan"]').val(data.penerangan);
                $('[name="suara"]').val(data.suara);
                $('[name="keadaan_tempat_kerja"]').val(data.keadaan_tempat_kerja);
                $('[name="getaran"]').val(data.getaran);
                $('#modalKondisiFisik').modal('show');
                $('.modal-title').text('Ubah');

            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Gagal mendapatkan data");
            }
        });
    }

    function simpanKondisiFisik() {
        var jenis_kelamin = $('[name="jenis_kelamin"]').val();
        var umur = $('[name="umur"]').val();
        var tinggi_badan = $('[name="tinggi_badan"]').val();
        var berat_badan = $('[name="berat_badan"]').val();
        var postur_badan = $('[name="postur_badan"]').val();
        var penampilan = $('[name="penampilan"]').val();
        var keadaan_fisik = $('[name="keadaan_fisik"]').val();

        if (jenis_kelamin == null) {
            alert('Jenis Kelamin harus diisi')
        }

        if (penampilan == null) {
            alert('Penampilan harus diisi')
        }

        if (keadaan_fisik == null) {
            alert('Keadaan fisik harus diisi')
        }

        if (jenis_kelamin !== '' && penampilan !== '' && keadaan_fisik) {
            $('#btnSaveKondisiFisik').text('Menyimpan...');
            $('#messageKondisiFisik').html('');
            $('#btnSaveKondisiFisik').attr('disabled', true);
            var url;
            var formData = new FormData($('#formKondisiFisik')[0]);
            if (save_method == 'add') {
                url = "<?= base_url() . 'simanja/analisis_jabatan/p_add_syarat_kondisi_fisik' ?>";
            } else {
                url = "<?= base_url() . 'simanja/analisis_jabatan/p_update_syarat_kondisi_fisik' ?>";
            }

            $.ajax({
                url: url,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function(data) {

                    if (data.status) {
                        $('#modalKondisiFisik').modal('hide');
                        swal("Berhasil", "Data Berhasil Disimpan!", "success");
                        window.location.replace(base_detail_anjab + '#tab_syarat_jabatan');
                        location.reload()
                    } else {
                        $('#messageKondisiFisik').html('<div class="alert alert-danger">' + data.message +
                            '</div>');
                    }
                    $('#btnSaveKondisiFisik').text('Simpan');
                    $('#btnSaveKondisiFisik').attr('disabled', false);


                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error adding / update data');
                    $('#btnSaveKondisiFisik').text('Simpan');
                    $('#btnSaveKondisiFisik').attr('disabled', false);

                }
            });
        }
    }

    function deleteKondisiFisik(id) {
        swal({
                title: "Hapus Data",
                text: "Apakah anda yakin akan menghapus data ini?",
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
                        url: "<?= base_url() . 'simanja/analisis_jabatan/delete_syarat_kondisi_fisik/' ?>" +
                            id,
                        type: "POST",
                        dataType: "JSON",
                        success: function(data) {
                            $('#modalKondisiFisik').modal('hide');
                            swal("Berhasil", "Data Berhasil Dihapus!", "success");
                            window.location.replace(base_detail_anjab + '#tab_syarat_jabatan');
                            location.reload()
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            alert('Error deleting data');
                        }
                    });
                }
            });
    }

    //Fungsi Pekerjaan
    function addFungsiPekerjaan(id) {
        save_method = 'add';
        $('#formFungsiPekerjaan')[0].reset();
        $('#messageFungsiPekerjaan').html('');
        $('#modalFungsiPekerjaan').modal('show');
        $('.modal-title').text('Manage');
        $.ajax({
            url: "<?= base_url() . 'simanja/analisis_jabatan/fetch_syarat_fungsi_pekerjaan/' ?>" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                let selected = []
                data.forEach((v) => {
                    selected.push(v.id)
                })
                $('#fungsi-pekerjaan-select2').val(selected);
                $('#fungsi-pekerjaan-select2').trigger('change');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Gagal mendapatkan data");
            }
        });
    }

    function simpanFungsiPekerjaan() {
        var listed = $('[name="listed[]"]').val();

        if (listed !== null) {
            alert('Fungsi pekerjaan harus diisi')
        }

        if (listed !== '') {
            $('#btnSaveFungsiPekerjaan').text('Menyimpan...');
            $('#messageFungsiPekerjaan').html('');
            $('#btnSaveFungsiPekerjaan').attr('disabled', true);
            var url;
            var formData = new FormData($('#formFungsiPekerjaan')[0]);
            if (save_method == 'add') {
                url = "<?= base_url() . 'simanja/analisis_jabatan/p_add_syarat_fungsi_pekerjaan' ?>";
            } else {
                url = "<?= base_url() . 'simanja/analisis_jabatan/p_update_syarat_fungsi_pekerjaan' ?>";
            }

            $.ajax({
                url: url,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function(data) {

                    if (data.status) {
                        $('#modalFungsiPekerjaan').modal('hide');
                        swal("Berhasil", "Data Berhasil Disimpan!", "success");
                        window.location.replace(base_detail_anjab + '#tab_syarat_jabatan');
                        location.reload()
                    } else {
                        $('#messageFungsiPekerjaan').html('<div class="alert alert-danger">' + data
                            .message + '</div>');
                    }
                    $('#btnSaveFungsiPekerjaan').text('Simpan');
                    $('#btnSaveFungsiPekerjaan').attr('disabled', false);


                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error adding / update data');
                    $('#btnSaveFungsiPekerjaan').text('Simpan');
                    $('#btnSaveFungsiPekerjaan').attr('disabled', false);

                }
            });
        }
    }

    //Sender

    function addSend(id) {
        save_method = 'add';
        $('#formSend')[0].reset();
        $('#messageSend').html('');
        $('#modalSend').modal('show');
        $('.modal-title').text('Kirim');
    }

    function simpanSend() {
        var id_pegawai = $('[name="id_pegawai"]').val();
        var id_verifikator = $('[name="id_verifikator"]').val();

        if (id_pegawai == null) {
            alert('Pemangku Jabatan harus diisi')
        }

        if (id_verifikator == null) {
            alert('Atasan Langsung / Verifikator harus diisi')
        }

        if (id_pegawai !== '' && id_verifikator !== '') {
            $('#btnSaveSend').text('Menyimpan...');
            $('#messageSend').html('');
            $('#btnSaveSend').attr('disabled', true);
            var url;
            var formData = new FormData($('#formSend')[0]);
            if (save_method == 'add') {
                url = "<?= base_url() . 'simanja/analisis_jabatan/p_add_sender' ?>";
            } else {
                url = "<?= base_url() . 'simanja/analisis_jabatan/p_update_sender' ?>";
            }

            $.ajax({
                url: url,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function(data) {

                    if (data.status) {
                        $('#modalSend').modal('hide');
                        swal("Berhasil", "Data Berhasil Disimpan!", "success");
                        location.reload();
                    } else {
                        $('#messageSend').html('<div class="alert alert-danger">' + data.message +
                            '</div>');
                    }
                    $('#btnSaveSend').text('Simpan');
                    $('#btnSaveSend').attr('disabled', false);


                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error adding / update data');
                    $('#btnSaveSend').text('Simpan');
                    $('#btnSaveSend').attr('disabled', false);

                }
            });
        }
    }

    jQuery(document).ready(function($) {
        let selectedTab = window.location.hash;
        $('a[href="' + selectedTab + '"]').trigger('click');
    });
    </script>