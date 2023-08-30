<style>
    .panel-warning a {
        color: #FFFFFF !important;
    }

    .label-white {
        background-color: #FFFFFF;
        color: blueviolet;
    }
</style>
<div class="container-fluid">

    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">LKE - <?= $nama ?></h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li>Lembar Kerja Evaluasi</li>
                <li class="active"><?= $nama ?></li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">

                <?php
                if (isset($message)) {
                ?>
                    <div class="alert alert-<?= $message_type ?>"><?= $message ?></div>
                <?php } ?>

                <?php
                $year = date('Y');
                ?>
                <form action="<?= base_url('lembar_kerja_evaluasi/zi_wbk_filter/') ?>" method="post">
                    <div class="row">
                        <div class="col-md-10">
                            <select name="tahun" class="form-control" style="margin-bottom: 30px;">
                                <option selected>Pilih Tahun Anggaran</option>
                                <?php for ($awal_tahun = $year; $awal_tahun <= 2023; $awal_tahun++) {  ?>
                                    <option value="<?= $awal_tahun; ?>"><?= $awal_tahun; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary btn-block">Filter</button>
                        </div>
                    </div>
                </form>
                <div class="alert alert-info" role="alert">
                    <b>LKE - ZONA INTEGRITAS (ZI) <?= $tahun ?></b>
                </div>

                <!-- <select class="form-control" style="margin-bottom: 30px;">
        <option selected>Pilih Tahun Anggaran</option>
        <option value="1" disabled>2020</option>
        <option value="2">2021</option>
        <option value="3" disabled>2022</option>
        <option value="4" disabled>2023</option>
        <option value="5" disabled>2024</option>
        <option value="6" disabled>2025</option>
        <span id="helpBlock2" class="help-block">Menu Aktif adalah menu yang dapat Diclick.</span>
        </select> -->

                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    <?php
                    foreach ($indikator as $n => $i) { ?>
                        <div class="panel panel-inverse">
                            <div class="panel-heading" role="tab" id="heading<?= $n ?>">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $n ?>" aria-expanded="true" aria-controls="collapse<?= $n ?>">
                                        <?= normal_string($i->nama_indikator) ?> (<?= normal_string($i->tahun) ?>) <span class="label label-white"><?= $i->nilai ?></span> <span class="label label-success"><?= $i->nilai_koreksi ?></span>
                                    </a>
                                </h4>
                            </div>

                            <div id="collapse<?= $n ?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading<?= $n ?>">
                                <div class="panel-body">
                                    <div class="panel-group" id="accordion<?= $n ?>" role="tablist" aria-multiselectable="true">
                                        <?php
                                        $indikator2 = $this->lembar_kerja_evaluasi_model->get_indikator_by_induk($i->id_lke_indikator);
                                        foreach ($indikator2 as $n2 => $i2) {
                                            $n2 = "level2" . $n . $n2;
                                        ?>
                                            <div class="panel panel-primary">
                                                <div class="panel-heading" role="tab" id="heading<?= $n2 ?>">
                                                    <h4 class="panel-title">
                                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion<?= $n ?>" href="#collapse<?= $n2 ?>" aria-expanded="true" aria-controls="collapse<?= $n2 ?>">
                                                            <?= normal_string($i2->nama_indikator) ?> (<?= normal_string($i->tahun) ?>) <span class="label label-white"><?= $i2->nilai ?></span> <span class="label label-success"><?= $i2->nilai_koreksi ?></span>
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapse<?= $n2 ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?= $n2 ?>">
                                                    <div class="panel-body">
                                                        <div class="panel-group" id="accordion<?= $n2 ?>" role="tablist" aria-multiselectable="true">
                                                            <?php
                                                            $indikator3 = $this->lembar_kerja_evaluasi_model->get_indikator_by_induk($i2->id_lke_indikator);
                                                            $nama_ketua = "";
                                                            foreach ($indikator3 as $n3 => $i3) {
                                                                $n3 = "level3" . $n2 . $n3;

                                                                $id_lke_ketua = $i3->id_lke_indikator;

                                                                $ketua_pokja = $this->lembar_kerja_evaluasi_model->get_ketua_pokja_by_id_indikator($id_lke_ketua, $id_skpd)->result();

                                                                foreach ($ketua_pokja as $kepok => $kp) {
                                                                    $nama_ketua = $kp->id;
                                                                }

                                                                $ketua = $this->lembar_kerja_evaluasi_model->get_pegawai_ketua($i3->id_lke_indikator, $id_skpd);
                                                            ?>
                                                                <div class="panel panel-info">
                                                                    <div class="panel-heading" role="tab" id="heading<?= $n3 ?>">
                                                                        <h4 class="panel-title">
                                                                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion<?= $n2 ?>" href="#collapse<?= $n3 ?>" aria-expanded="true" aria-controls="collapse<?= $n3 ?>">
                                                                                <?= normal_string($i3->nama_indikator) ?> (<?= normal_string($i->tahun) ?>) <?php
                                                                                                                                                            if ($ketua) {
                                                                                                                                                                if ($ketua->id_pegawai == $this->session->userdata('id_pegawai')) {
                                                                                                                                                                    echo '<span class="label label-success">' . $ketua->nama_lengkap . '</span>';
                                                                                                                                                                } else {
                                                                                                                                                                    echo $ketua->nama_lengkap;
                                                                                                                                                                }
                                                                                                                                                            }
                                                                                                                                                            ?> <span class="label label-white"><?= $i3->nilai ?></span> <span class="label label-success"><?= $i3->nilai_koreksi ?></span>
                                                                            </a>
                                                                        </h4>
                                                                    </div>

                                                                    <div id="collapse<?= $n3 ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?= $n3 ?>">
                                                                        <div class="panel-body">

                                                                            <div class="panel-group" id="accordion<?= $n3 ?>" role="tablist" aria-multiselectable="true">
                                                                                <?php
                                                                                $jml_id = 0;
                                                                                $id_lke = $i3->id_lke_indikator;
                                                                                $pokja = $this->lembar_kerja_evaluasi_model->get_id_lke_indikator($id_pegawai, $id_lke)->result();
                                                                                foreach ($pokja as $p) {
                                                                                    $jml_id = $p->id_pokja;
                                                                                }
                                                                                if ($jml_id > 0) {
                                                                                    $indikator4 = $this->lembar_kerja_evaluasi_model->get_indikator_by_induk($i3->id_lke_indikator);
                                                                                    foreach ($indikator4 as $n4 => $i4) {
                                                                                        $n4 = "level4" . $n3 . $n4;
                                                                                        $pengaturan_waktu = $this->lembar_kerja_evaluasi_model->get_setting_waktu('skpd', $i4->tahun);
                                                                                ?>
                                                                                        <div class="panel panel-warning">
                                                                                            <div class="panel-heading" role="tab" id="heading<?= $n4 ?>">
                                                                                                <h4 class="panel-title">
                                                                                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion<?= $n3 ?>" href="#collapse<?= $n4 ?>" aria-expanded="true" aria-controls="collapse<?= $n4 ?>">
                                                                                                        <?= normal_string($i4->nama_indikator) ?> <span class="label label-white"> <?= $i4->nilai ?></span> <span class="label label-success"><?= $i4->nilai_koreksi ?></span>
                                                                                                    </a>
                                                                                                </h4>
                                                                                            </div>
                                                                                            <div id="collapse<?= $n4 ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?= $n4 ?>">
                                                                                                <div class="panel-body">

                                                                                                    <div class="table-responsive">
                                                                                                        <table id="tabel<?= $n4 ?>" class="table color-table muted-table">
                                                                                                            <thead>
                                                                                                                <tr>
                                                                                                                    <th class="text-center" width="3%">No.</th>
                                                                                                                    <th width="40%">Penilaian</th>
                                                                                                                    <th width="12%">Pilihan Jawaban</th>
                                                                                                                    <th>Jawaban</th>
                                                                                                                    <th>Nilai</th>
                                                                                                                    <th class="text-center" width="80px">Aksi</th>
                                                                                                                </tr>
                                                                                                            </thead>
                                                                                                            <tbody>
                                                                                                                <?php
                                                                                                                $indikator_jawaban = $this->lembar_kerja_evaluasi_model->get_indikator_by_induk($i4->id_lke_indikator, true, $id_skpd, true);
                                                                                                                if (empty($indikator_jawaban)) {
                                                                                                                ?>
                                                                                                                    <tr>
                                                                                                                        <td colspan="4">
                                                                                                                            <center>Data tidak ditemukan</center>
                                                                                                                        </td>
                                                                                                                    </tr>
                                                                                                                    <?php
                                                                                                                } else {
                                                                                                                    foreach ($indikator_jawaban as $k => $j) {
                                                                                                                        $no = $k + 1;
                                                                                                                    ?>
                                                                                                                        <tr>
                                                                                                                            <td class="text-center"><?= $no ?></td>
                                                                                                                            <td><?= $j->nama_indikator ?></td>
                                                                                                                            <td><?= normal_string($j->alias_jenis_jawaban) ?></td>
                                                                                                                            <td>
                                                                                                                                <?= $j->jawaban ?>
                                                                                                                                <?php if ($j->jawaban_koreksi !== "Belum diisi") { ?>
                                                                                                                                    <div class="alert alert-success" style="margin-top:10px">
                                                                                                                                        <b>Koreksi :</b> <br>
                                                                                                                                        <?= $j->jawaban_koreksi ?>
                                                                                                                                    </div>
                                                                                                                                <?php } ?>
                                                                                                                            </td>
                                                                                                                            <td><?= $j->nilai ?>
                                                                                                                                <?php if ($j->jawaban_koreksi !== "Belum diisi") { ?>
                                                                                                                                    <div class="alert alert-success" style="margin-top:10px">
                                                                                                                                        <?= $j->nilai_koreksi ?>
                                                                                                                                    </div>
                                                                                                                                <?php } ?>
                                                                                                                            </td>
                                                                                                                            <td class="text-center">
                                                                                                                                <?php if ($j->jawaban == "Belum diisi") { ?>
                                                                                                                                    <?php
                                                                                                                                    if ($pengaturan_waktu && (date('Y-m-d H:i:s') > $pengaturan_waktu->tanggal_buka && date('Y-m-d H:i:s') < $pengaturan_waktu->tanggal_tutup)) {
                                                                                                                                    ?>
                                                                                                                                        <a href="javascript:void(0)" onclick="isiJawaban(<?= $j->id_lke_indikator ?>,'tabel<?= $n4 ?>',<?= $i4->id_lke_indikator ?>)" class="btn btn-sm btn-block mb-2 btn-primary">Isi Jawaban</a>
                                                                                                                                    <?php } ?>
                                                                                                                                <?php } else { ?>
                                                                                                                                    <a href="javascript:void(0)" onclick="lihatJawaban(<?= $j->id_lke_jawaban ?>)" class="btn btn-sm btn-block mb-2 btn-success">Detail Jawaban</a>
                                                                                                                                    <?php
                                                                                                                                    if ($pengaturan_waktu && (date('Y-m-d H:i:s') > $pengaturan_waktu->tanggal_buka && date('Y-m-d H:i:s') < $pengaturan_waktu->tanggal_tutup)) {
                                                                                                                                    ?>
                                                                                                                                        <a href="javascript:void(0)" onclick="editJawaban(<?= $j->id_lke_jawaban ?>,'tabel<?= $n4 ?>')" class="btn btn-sm btn-block mb-2 btn-info">Edit Jawaban</a>
                                                                                                                                    <?php } ?>
                                                                                                                                    <?php if ($j->jawaban_koreksi !== "Belum diisi") { ?>
                                                                                                                                        <a href="javascript:void(0)" onclick="lihatJawabanKoreksi(<?= $j->id_lke_jawaban_koreksi ?>)" class="btn btn-block mb-2  btn-sm btn-success">Detail Koreksi</a>

                                                                                                                                    <?php } ?>
                                                                                                                            </td>
                                                                                                                        <?php } ?>
                                                                                                                        </td>
                                                                                                                        </tr>
                                                                                                                <?php
                                                                                                                    }
                                                                                                                } ?>
                                                                                                            </tbody>
                                                                                                        </table>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                <?php }
                                                                                } ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalJawaban" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myLargeModalLabel">Isi Jawaban</h4>
            </div>
            <div class="modal-body">
                <div id="message"></div>
                <form id="formJawaban" action="<?= base_url('lembar_kerja_evaluasi/post_jawaban') ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id_lke_indikator">
                    <input type="hidden" name="jenis_jawaban">
                    <input type="hidden" name="id_induk">
                    <input type="hidden" name="tabel">
                    <small><b>Penilaian</b></small>
                    <p id="nama_indikator"></p>
                    <small><b>Jawaban</b></small>
                    <div id="jawaban"></div>
                    <small><b>Catatan / Keterangan / Penjelasan</b></small>
                    <textarea class="form-control" rows="5" placeholder="Masukkan Catatan / Keterangan / Penjelasan" name="catatan"></textarea>
                    <div style="margin-top: 10px;">
                        <small><b>Lampiran / Evidence</b></small>
                        <input type="file" class="dropify" name="lampiran">
                    </div>
            </div>
            <div class="modal-footer">
                <a href="javascript:void(0)" data-dismiss="modal" class="btn btn-default waves-effect text-left">Batal</a>
                <button type="submit" id="btnSimpan" class="btn btn-primary waves-effect text-left">Simpan</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<div class="modal fade" id="modalEditJawaban" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myLargeModalLabel">Edit Jawaban</h4>
            </div>
            <div class="modal-body">
                <div id="message"></div>
                <form id="formEditJawaban" action="<?= base_url('lembar_kerja_evaluasi/post_jawaban/edit') ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id_lke_jawaban">
                    <input type="hidden" name="tabel">
                    <small><b>Penilaian</b></small>
                    <p id="nama_indikator"></p>
                    <small><b>Jawaban</b></small>
                    <div id="jawaban"></div>
                    <small><b>Catatan / Keterangan / Penjelasan</b></small>
                    <textarea class="form-control" rows="5" placeholder="Masukkan Catatan / Keterangan / Penjelasan" name="catatan"></textarea>
                    <div style="margin-top: 10px;">
                        <small><b>Lampiran / Evidence</b> <a style="margin-bottom: 7.5px;" href="" target="blank" id="lampiran_jawaban_lama" class="btn btn-primary btn-xs"><i class="ti-eye"></i> Lihat Lampiran Sebelumnya</a></small>
                        <input type="file" class="dropify" name="lampiran">
                    </div>
            </div>
            <div class="modal-footer">
                <a href="javascript:void(0)" data-dismiss="modal" class="btn btn-default waves-effect text-left">Batal</a>
                <button type="submit" id="btnUpdate" class="btn btn-primary waves-effect text-left">Update</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modalDetailJawaban" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myLargeModalLabel">Detail Jawaban</h4>
            </div>
            <div class="modal-body">

                <small><b>Penilaian</b></small>
                <p id="nama_indikator_jawaban"></p>
                <small><b>Jawaban</b></small>
                <p id="jawaban_jawaban"></p>
                <small><b>Catatan / Keterangan / Penjelasan</b></small>
                <p id="catatan_jawaban"></p>
                <div style="margin-top: 10px;">
                    <small><b>Lampiran / Evidence</b></small><br>
                    <a href="" target="blank" id="lampiran_jawaban" class="btn btn-primary btn-sm"><i class="ti-download"></i> Download Lampiran</a>
                </div>
            </div>
            <div class="modal-footer">
                <a href="javascript:void(0)" data-dismiss="modal" class="btn btn-default waves-effect text-left">Tutup</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<div class="modal fade" id="modalDetailJawabanKoreksi" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myLargeModalLabel">Detail Jawaban Koreksi</h4>
            </div>
            <div class="modal-body">

                <small><b>Penilaian</b></small>
                <p id="nama_indikator_jawabanKoreksi"></p>
                <small><b>Jawaban</b></small>
                <p id="jawaban_jawabanKoreksi"></p>
                <small><b>Catatan / Keterangan / Penjelasan</b></small>
                <p id="catatan_jawabanKoreksi"></p>
            </div>
            <div class="modal-footer">
                <a href="javascript:void(0)" data-dismiss="modal" class="btn btn-default waves-effect text-left">Tutup</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script>
    function isiJawaban(idIndikator, tabel, id_induk) {
        $("#message").html('');
        $("#jawaban").html('Jawaban belum tersedia');
        $('#formJawaban').find('input:text').val('');
        $('#formJawaban').find('textarea').val('');
        $(".dropify-clear").trigger("click");
        $.getJSON("<?= base_url('lembar_kerja_evaluasi/get_jawaban') ?>/" + idIndikator, function(data) {
            $('[name="id_lke_indikator"]').val(idIndikator);
            $('[name="id_induk"]').val(id_induk);
            $('[name="tabel"]').val(tabel);
            $('[name="jenis_jawaban"]').val(data.jenis_jawaban);
            $('#nama_indikator').html(data.nama_indikator);
            var html = '';
            if (data.jenis_jawaban == 'multiple') {
                $.each(data.jawaban, function(i, j) {
                    html += '<div class="radio radio-primary"><input type="radio" name="jawaban" id="radio' + i + '" value="' + j.id_lke_indikator_pilihan + '"><label for="radio' + i + '">' + j.penjelasan + '</label></div>';
                });
            } else {
                if (data.jawaban) {
                    html += data.jawaban.penjelasan;
                }
                if (data.jenis_jawaban == 'switch') {
                    html += '<div class="radio radio-primary"><input type="radio" name="jawaban" id="radio_ya" value="Ya"><label for="radio_ya">Ya</label></div>';
                    html += '<div class="radio radio-primary"><input type="radio" name="jawaban" id="radio_tidak" value="Tidak"><label for="radio_tidak">Tidak</label></div>';
                } else {
                    html += '<input style="margin-bottom:10px" placeholder="Masukkan ' + data.jenis_jawaban.charAt(0).toUpperCase() + data.jenis_jawaban.slice(1) + '" type="text" class="form-control" name="jawaban">';
                }
            }
            $('#jawaban').html(html);
            $('#modalJawaban').modal('show');
        });
    }


    function editJawaban(idJawaban, tabel) {
        $("#modalEditJawaban #message").html('');
        $("#modalEditJawaban #jawaban").html('Jawaban belum tersedia');
        $('#formEditJawaban').find('input:text').val('');
        $('#formEditJawaban').find('textarea').val('');
        $("#modalEditJawaban .dropify-clear").trigger("click");
        $.getJSON("<?= base_url('lembar_kerja_evaluasi/get_detail_jawaban') ?>/" + idJawaban, function(data) {
            $('#formEditJawaban [name="catatan"]').val(data.catatan);
            $('#formEditJawaban [name="id_lke_jawaban"]').val(data.id_lke_jawaban);
            $('#formEditJawaban [name="tabel"]').val(tabel);
            $('#lampiran_jawaban_lama').attr('href', '<?= base_url('data/lampiran_lke') ?>/' + data.lampiran);
            var html = '';
            if (data.jenis_jawaban == 'multiple') {
                $.each(data.list_jawaban, function(i, j) {
                    var checked;
                    if (j.id_lke_indikator_pilihan == data.id_jawaban) {
                        checked = ' checked';
                    } else {
                        checked = '';
                    }
                    html += '<div class="radio radio-primary"><input type="radio" name="jawaban" id="radio' + i + '" value="' + j.id_lke_indikator_pilihan + '"' + checked + '><label for="radio' + i + '">' + j.penjelasan + '</label></div>';
                });
            } else {
                if (data.list_jawaban) {
                    html += data.list_jawaban.penjelasan;
                }
                if (data.jenis_jawaban == 'switch') {
                    var checked_ya;
                    if (data.jawaban == "Ya") {
                        checked_ya = ' checked';
                    } else {
                        checked_ya = '';
                    }
                    var checked_tidak;
                    if (data.jawaban == "Tidak") {
                        checked_tidak = ' checked';
                    } else {
                        checked_tidak = '';
                    }
                    html += '<div class="radio radio-primary"><input type="radio" name="jawaban" id="radio_ya" value="Ya"' + checked_ya + '><label for="radio_ya">Ya</label></div>';
                    html += '<div class="radio radio-primary"><input type="radio" name="jawaban" id="radio_tidak" value="Tidak"' + checked_tidak + '><label for="radio_tidak">Tidak</label></div>';
                } else {
                    html += '<input style="margin-bottom:10px" placeholder="Masukkan ' + data.jenis_jawaban.charAt(0).toUpperCase() + data.jenis_jawaban.slice(1) + '" type="text" class="form-control" name="jawaban" value="' + data.jawaban + '">';
                }
            }
            $('#formEditJawaban #jawaban').html(html);
            $('#modalEditJawaban').modal('show');
        });
    }

    function lihatJawaban(idJawaban) {
        $.getJSON("<?= base_url('lembar_kerja_evaluasi/get_detail_jawaban') ?>/" + idJawaban, function(data) {
            $('#nama_indikator_jawaban').html(data.nama_indikator);
            $('#jawaban_jawaban').html(data.jawaban);
            $('#catatan_jawaban').html(data.catatan);
            $('#lampiran_jawaban').attr('href', '<?= base_url('data/lampiran_lke') ?>/' + data.lampiran);
            $('#modalDetailJawaban').modal('show');
        });
    }

    function lihatJawabanKoreksi(idJawabanKoreksi) {
        $.getJSON("<?= base_url('lembar_kerja_evaluasi/get_detail_jawaban_koreksi') ?>/" + idJawabanKoreksi, function(data) {
            $('#nama_indikator_jawabanKoreksi').html(data.nama_indikator);
            $('#jawaban_jawabanKoreksi').html(data.jawaban);
            $('#catatan_jawabanKoreksi').html(data.catatan);
            $('#modalDetailJawabanKoreksi').modal('show');
        });
    }
    $(document).ready(function(e) {
        $("#formJawaban").on('submit', (function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= base_url('lembar_kerja_evaluasi/post_jawaban') ?>",
                type: "POST",
                dataType: "JSON",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    //$("#preview").fadeOut();
                    $("#message").fadeOut();
                    $("#btnSimpan").html('Menyimpan ...');
                },
                success: function(data) {
                    if (data.status == 0) {
                        $("#message").html('<div class="alert alert-warning">' + data.message + '</div>').fadeIn();
                    } else {
                        $("#message").html('<div class="alert alert-success">' + data.message + '</div>').fadeIn();
                        $('#' + data.tabel + ' tbody').html(data.data);
                        $('#modalJawaban').modal('hide');
                        swal("Sukses", data.message, "success");
                    }
                    $("#btnSimpan").html('Simpan');
                },
                error: function(e) {
                    $("#message").html('<div class="alert alert-danger">' + e + '</div>').fadeIn();
                    $("#btnSimpan").html('Simpan');
                }
            });
        }));
    });


    $(document).ready(function(e) {
        $("#formEditJawaban").on('submit', (function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= base_url('lembar_kerja_evaluasi/post_jawaban/edit') ?>",
                type: "POST",
                dataType: "JSON",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    //$("#preview").fadeOut();
                    $("#modalEditJawaban #message").fadeOut();
                    $("#btnUpdate").html('Menyimpan ...');
                },
                success: function(data) {
                    if (data.status == 0) {
                        $("#modalEditJawaban #message").html('<div class="alert alert-warning">' + data.message + '</div>').fadeIn();
                    } else {
                        $("#modalEditJawaban #message").html('<div class="alert alert-success">' + data.message + '</div>').fadeIn();
                        $('#' + data.tabel + ' tbody').html(data.data);
                        $('#modalEditJawaban').modal('hide');
                        swal("Sukses", data.message, "success");
                    }
                    $("#btnUpdate").html('Simpan');
                },
                error: function(e) {
                    $("#modalEditJawaban #message").html('<div class="alert alert-danger">' + e + '</div>').fadeIn();
                    $("#btnUpdate").html('Simpan');
                }
            });
        }));
    });

    function simpanJawaban() {
        var id_lke_indikator = $('[name="id_lke_indikator"]').val();
        var jenis_jawaban = $('[name="jenis_jawaban"]').val();
        var jawaban;
        if (jenis_jawaban == 'multiple') {
            jawaban = $('input[name="jawaban"]:checked').val();
        } else {
            jawaban = $('input[name="jawaban"]').val();
        }
        var catatan = $('[name="catatan"]').val();
    }
</script>