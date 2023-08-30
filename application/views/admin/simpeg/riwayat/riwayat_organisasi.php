<section class="data-list-view-header">
    <!-- RW organisasi -->
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <h4 class="card-title">Riwayat Organisasi <button type="button" onclick="tambah_organisasi();"
                        class="btn btn-sm btn-primary waves-effect waves-light pull-right">Tambah</button></h4>
                <hr />
                <div class="table-responsive">
                    <table class="table table-striped datatable">
                        <thead>
                            <tr>
                                <th>Nama Organisasi</th>
                                <th>Jenis</th>
                                <th>Kedudukan</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Akhir <span class="fa fa-sort-desc"></span></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($organisasi as $row1): $row = $row1; ?>
                            <?php foreach ($dump_organisasi['update'] as $row2): ?>
                            <?php
									if($row1->id_organisasi == $row2->id_organisasi) {
										$row = $row2;
										$row->nama_kepanitiaan = convert_data($ref_kepanitiaan,'kode_kepanitiaan',$row->kode_kepanitiaan,'nama_kepanitiaan');
									}
									?>
                            <?php endforeach ?>
                            <?php foreach ($dump_organisasi['delete'] as $row2): ?>
                            <?php
									if($row1->id_organisasi == $row2->id_organisasi) {
										$row->id_update = $row2->id_update;
										$row->status_verifikasi = $row2->status_verifikasi;
										$row->status_update = $row2->status_update;
										$row->alasan = $row2->alasan;
									}
									?>
                            <?php endforeach ?>
                            <tr class="<?=get_status_riwayat_simpeg($row)?>">
                                <td><?=$row->nama_organisasi?></td>
                                <td><?=$row->nama_kepanitiaan?></td>
                                <td><?=$row->kedudukan?></td>
                                <td><?=tanggal($row->tmt_mulai)?></td>
                                <td><?=($row->tmt_berakhir) ? tanggal($row->tmt_berakhir) : "Sampai sekarang"?></td>
                                <td>
                                    <div class="badge badge-pill badge-glow badge-light-primary mr-1 mb-1"><?=@$row->status_verifikasi?><?=(@$row->status_update=="DELETE")?" Hapus Data":""?></div>
                                </td>
                                <td>
                                    <?php if (@$row->status_verifikasi == "Ditolak"): ?>
                                    <div class="alert alert-primary alert-validation-msg" role="alert"
                                        style="padding: 0; font-weight: unset;">
                                        <i class="feather icon-info align-middle"></i>
                                        <span><?=$row->alasan?></span>
                                    </div>
                                    <?php endif ?>

                                    <?php if (@$row->status_verifikasi == "Proses" AND @$row->status_update != "DELETE" AND ($this->user_level=="Administrator" OR in_array('kepegawaian', $this->user_privileges))): ?>
                                    <button type="button" onclick="verifikasi_organisasi('<?=$row->id_organisasi?>');"
                                        class="btn btn-success btn-sm mr-1 mb-1">Verifikasi</button>
                                    <?php endif ?>

                                    <?php if (@$row->status_verifikasi == "Proses" AND @$row->status_update == "DELETE" AND ($this->user_level=="Administrator" OR in_array('kepegawaian', $this->user_privileges))): ?>
                                    <button type="button" onclick="verifikasi_hapus_organisasi('<?=$row->id_update?>');"
                                        class="btn btn-danger btn-sm mr-1 mb-1">Verifikasi Hapus</button>
                                    <div class="alert alert-primary alert-validation-msg" role="alert"
                                        style="padding: 0; font-weight: unset;">
                                        <i class="feather icon-info align-middle"></i>
                                        <span><?=$row->alasan?></span>
                                    </div>
                                    <?php endif ?>

                                    <?php if (@$row->status_verifikasi != "Diterima" AND @$row->status_update != "DELETE"): ?>
                                    <button type="button" onclick="edit_organisasi('<?=$row->id_organisasi?>');"
                                        class="btn btn-success btn-sm mr-1 mb-1">Ubah</button>
                                    <?php endif ?>

                                    <?php if (@$row->status_verifikasi != "Diterima" AND @$row->id_update): ?>
                                    <button type="button" onclick="batal_organisasi('<?=$row->id_update?>');"
                                        class="btn btn-sm btn-outline-dark mr-1 mb-1">Batal</button>
                                    <?php endif ?>

                                    <?php if (@!$row->id_update): ?>
                                    <button type="button" onclick="hapus_organisasi('<?=$row->id_organisasi?>');"
                                        class="btn btn-sm btn-outline-danger mr-1 mb-1">Hapus</button>
                                    <?php endif ?>
                                    <?php if ($row->status != "Y"): ?>
                                    <!-- <button type="button" onclick="aktif_organisasi('<?=$row->id_organisasi?>');" class="btn bg-gradient-primary btn-sm mr-sm-1 mr-1 mb-1">Aktifkan</button> -->
                                    <?php endif ?>

                                    <?php if (isset($row->berkas)): ?>
                                    <a href="<?=base_url()?>data/simpeg/riwayat_organisasi/<?=$row->berkas?>"
                                        target="_blank" class="btn btn-sm btn-light mr-1 mb-1">Lihat Berkas</a>
                                    <?php endif ?>
                                </td>
                            </tr>
                            <?php foreach ($row as $k => $v): ?>
                            <var class="hidden" id="organisasi-<?=$k?>_<?=$row->id_organisasi?>"><?=$v?></var>
                            <?php endforeach ?>
                            <?php endforeach ?>
                            <?php foreach ($dump_organisasi['insert'] as $row1): $row = $row1; ?>
                            <?php 
								$row->nama_kepanitiaan = convert_data($ref_kepanitiaan,'kode_kepanitiaan',$row->kode_kepanitiaan,'nama_kepanitiaan');
								?>
                            <tr class="<?=get_status_riwayat_simpeg($row)?>">
                                <td><?=$row->nama_organisasi?></td>
                                <td><?=$row->nama_kepanitiaan?></td>
                                <td><?=$row->kedudukan?></td>
                                <td><?=tanggal($row->tmt_mulai)?></td>
                                <td><?=($row->tmt_berakhir) ? tanggal($row->tmt_berakhir) : "Sampai sekarang"?></td>
                                <td>
                                    <div class="badge badge-pill badge-glow badge-light-primary mr-1 mb-1"><?=@$row->status_verifikasi?></div>
                                </td>
                                <td>
                                    <?php if (@$row->status_verifikasi == "Ditolak"): ?>
                                    <div class="alert alert-primary alert-validation-msg" role="alert"
                                        style="padding: 0; font-weight: unset;">
                                        <i class="feather icon-info align-middle"></i>
                                        <span><?=$row->alasan?></span>
                                    </div>
                                    <?php endif ?>

                                    <?php if (@$row->status_verifikasi == "Proses" AND ($this->user_level=="Administrator" OR in_array('kepegawaian', $this->user_privileges))): ?>
                                    <button type="button"
                                        onclick="verifikasi_organisasi('<?=$row->id_update?>_<?=$row->id_organisasi?>');"
                                        class="btn btn-success btn-sm mr-1 mb-1">Verifikasi</button>
                                    <?php endif ?>

                                    <?php if (@$row->status_verifikasi != "Diterima"): ?>
                                    <button type="button"
                                        onclick="edit_organisasi('<?=$row->id_update?>_<?=$row->id_organisasi?>');"
                                        class="btn btn-success btn-sm mr-1 mb-1">Ubah</button>
                                    <?php endif ?>

                                    <?php if (@$row->status_verifikasi != "Diterima" AND @$row->id_update): ?>
                                    <button type="button" onclick="batal_organisasi('<?=$row->id_update?>');"
                                        class="btn btn-sm btn-outline-dark mr-1 mb-1">Batal</button>
                                    <?php endif ?>

                                    <?php if (isset($row->berkas)): ?>
                                    <a href="<?=base_url()?>data/simpeg/riwayat_organisasi/<?=$row->berkas?>"
                                        target="_blank" class="btn btn-sm btn-light mr-1 mb-1">Lihat Berkas</a>
                                    <?php endif ?>
                                </td>
                            </tr>
                            <?php foreach ($row as $k => $v): ?>
                            <var class="hidden"
                                id="organisasi-<?=$k?>_<?=$row->id_update?>_<?=$row->id_organisasi?>"><?=$v?></var>
                            <?php endforeach ?>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- add new sidebar starts -->
    <div class="add-new-data-sidebar">
        <div class="overlay-bg organisasi" onclick="close_sidebar('organisasi')"></div>
        <div class="add-new-data organisasi fileframe hide">
            <button class="btn btn-icon rounded-circle btn-outline-primary" onclick="close_sidebar('organisasi')"
                style="position: absolute; top:13px; left:12px;"><i class="feather icon-x"></i></button>
            <iframe id="organisasi-fileframe" src="" frameborder="0"
                style="overflow: scroll; overflow-x: hidden; overflow-y: scroll; padding:0px;margin:0px; width: 100%; height: 100%;"></iframe>
        </div>
        <div class="add-new-data organisasi" style="overflow-y: auto;">
            <form action="javascript: void(0)" id="form-organisasi" onsubmit="submit_organisasi()"
                enctype="multipart/form-data">
                <input type="hidden" id="organisasi-csrf" name="<?=$this->security->get_csrf_token_name();?>"
                    value="<?= $this->security->get_csrf_hash();?>" />
                <input type="hidden" name="id_update" id="organisasi-id_update" value="" />
                <input type="hidden" name="id_organisasi" id="organisasi-id_organisasi" value="" />
                <input type="hidden" name="id_pegawai" value="<?=$id?>" />
                <input type="hidden" name="nip_pegawai" value="<?=$nip?>" />
                <div class="div mt-2 px-2 d-flex new-data-title justify-content-between">
                    <div>
                        <h4 class="text-uppercase">Riwayat Organisasi</h4>
                    </div>
                    <div class="hide-data-sidebar" onclick="close_sidebar('organisasi')">
                        <i class="feather icon-x"></i>
                    </div>
                </div>
                <div class="data-items pb-3">
                    <div class="data-fields px-2">
                        <div class="row">
                            <!-- <div class="col-sm-12 data-field-col"> -->
                            <!-- <label for="data-name">Kode BKN</label> -->
                            <input type="hidden" name="kode_bkn_organisasi" id="organisasi-kode_bkn_organisasi"
                                class="form-control" placeholder="diisi oleh admin simpeg">
                            <!-- </div> -->
                            <div class="col-sm-12 data-field-col">
                                <label for="data-name">Nama Organisasi</label>
                                <input type="text" name="nama_organisasi" id="organisasi-nama_organisasi"
                                    class="form-control" required="">
                            </div>
                            <div class="col-sm-12 data-field-col">
                                <label for="data-name">Jenis Organisasi</label>
                                <select class="form-control select2" id="organisasi-kode_kepanitiaan"
                                    name="kode_kepanitiaan" required="">
                                    <option value="">-- PILIH --</option>
                                    <?php foreach ($ref_kepanitiaan as $row): ?>
                                    <option value="<?=$row->kode_kepanitiaan?>"><?=$row->nama_kepanitiaan?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="col-sm-12 data-field-col">
                                <label for="data-name">Kedudukan</label>
                                <input type="text" name="kedudukan" id="organisasi-kedudukan" class="form-control"
                                    placeholder="contoh: ketua" required="">
                            </div>
                            <div class="col-sm-12 data-field-col">
                                <label for="data-name">TMT Mulai</label>
                                <input type="date" name="tmt_mulai" id="organisasi-tmt_mulai" class="form-control"
                                    required="">
                            </div>
                            <div class="col-sm-12 data-field-col">
                                <label for="data-name">TMT Berakhir</label>
                                <label class="pull-right"><input type="checkbox"
                                        onchange="$('#organisasi-tmt_berakhir').attr('disabled', $(this).is(':checked'));"
                                        name="tmt_berakhir" value=""> Sampai sekarang</label>
                                <input type="date" name="tmt_berakhir" id="organisasi-tmt_berakhir" class="form-control"
                                    required="">
                            </div>
                            <div class="col-sm-12 data-field-col">
                                <fieldset class="form-group">
                                    <label for="data-name">Upload Berkas</label>
                                    <div class="custom-file">
                                        <input type="file" name="berkas" class="custom-file-input"
                                            id="organisasi-berkas" accept="application/pdf">
                                        <label class="custom-file-label" for="organisasi-berkas">Pilih Berkas
                                            PDF</label>
                                    </div>
                                    <a id="organisasi-filelink" href="" target="_blank"></a>
                                </fieldset>
                            </div>
                            <div id="organisasi-input-alasan" class="col-sm-12 data-field-col">
                                <label for="data-name">Alasan Penolakan</label>
                                <textarea name="alasan" id="organisasi-alasan" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="add-data-footer d-flex justify-content-around px-3 mt-2 pb-3">
                    <input type="hidden" id="organisasi-input-verifikasi" name="verifikasi">
                    <div class="add-data-btn">
                        <button id="organisasi-btn-simpan" type="submit" class="btn btn-primary"
                            onclick="$('#organisasi-input-verifikasi').val('')">Simpan</button>
                        <button id="organisasi-btn-verifikasi" type="submit" class="btn btn-primary"
                            onclick="$('#organisasi-input-verifikasi').val('verifikasi')">Verifikasi</button>
                    </div>
                    <div class="cancel-data-btn">
                        <button id="organisasi-btn-batal" type="button" class="btn btn-outline-danger"
                            onclick="close_sidebar('organisasi')">Batal</button>
                        <button id="organisasi-btn-tolak" type="submit" class="btn btn-outline-danger"
                            onclick="$('#organisasi-input-verifikasi').val('tolak')">Tolak</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- add new sidebar ends -->

<script>
function submit_organisasi() {
    var formData = new FormData($('#form-organisasi')[0]);
    var _csrfName = $('input#organisasi-csrf').attr('name');
    var _csrfValue = $('input#organisasi-csrf').val();
    var file_data = $('#organisasi-berkas').prop('files')[0];
    formData.append('berkas', file_data);
    formData.append(_csrfName, _csrfValue);

    block_ui("body");
    $.ajax({
        url: "<?php echo base_url("simpeg/submit_riwayat/organisasi")?>",
        type: 'post',
        data: formData,
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
            console.log(data);

            swal("Data berhasil diupdate", data.error, {
                icon: "success",
            });

            setTimeout(function() {
                get_riwayat('organisasi');
            }, 500);
        },
        error: function(xhr, status, error) {
            swal("Opps", "Error", "error");
            console.log(xhr);

            setTimeout(function() {
                get_riwayat('organisasi');
            }, 500);
        }
    });
}

function edit_organisasi(id) {
    //alert(id);
    open_fileframe('organisasi', $("#organisasi-berkas_" + id).html())
    $("#organisasi-filelink").html("");
    $("#organisasi-filelink").html($("#organisasi-berkas_" + id).html());
    $("#organisasi-filelink").attr("href", '<?=base_url()?>data/simpeg/riwayat_organisasi/' + $("#organisasi-berkas_" +
        id).html());

    $("#organisasi-id_update").val($("#organisasi-id_update_" + id).html());
    $("#organisasi-id_organisasi").val($("#organisasi-id_organisasi_" + id).html());
    //ambil data
    var kode_bkn_organisasi = $("#organisasi-kode_bkn_organisasi_" + id).html();

    var nama_organisasi = $("#organisasi-nama_organisasi_" + id).html();
    var kode_kepanitiaan = $("#organisasi-kode_kepanitiaan_" + id).html();
    var kedudukan = $("#organisasi-kedudukan_" + id).html();
    var tmt_mulai = $("#organisasi-tmt_mulai_" + id).html();
    var tmt_berakhir = $("#organisasi-tmt_berakhir_" + id).html();

    //set data
    $("#organisasi-kode_bkn_organisasi").val(kode_bkn_organisasi);

    $("#organisasi-nama_organisasi").val(nama_organisasi);
    $("#organisasi-kode_kepanitiaan").val(kode_kepanitiaan).trigger("change");
    $("#organisasi-kedudukan").val(kedudukan);
    $("#organisasi-tmt_mulai").val(tmt_mulai);
    $("#organisasi-tmt_berakhir").val(tmt_berakhir);

    $(".add-new-data.organisasi").addClass("show");
    $(".overlay-bg.organisasi").addClass("show");

    $("#organisasi-btn-simpan").removeClass("hidden");
    $("#organisasi-btn-batal").removeClass("hidden");

    $("#organisasi-input-alasan").addClass("hidden");
    $("#organisasi-btn-verifikasi").addClass("hidden");
    $("#organisasi-btn-tolak").addClass("hidden");
}

function verifikasi_organisasi(id) {
    //alert(id);
    open_fileframe('organisasi', $("#organisasi-berkas_" + id).html())
    $("#organisasi-filelink").html("");
    $("#organisasi-filelink").html($("#organisasi-berkas_" + id).html());
    $("#organisasi-filelink").attr("href", '<?=base_url()?>data/simpeg/riwayat_organisasi/' + $("#organisasi-berkas_" +
        id).html());

    $("#organisasi-id_update").val($("#organisasi-id_update_" + id).html());
    $("#organisasi-id_organisasi").val($("#organisasi-id_organisasi_" + id).html());
    //ambil data
    var kode_bkn_organisasi = $("#organisasi-kode_bkn_organisasi_" + id).html();

    var nama_organisasi = $("#organisasi-nama_organisasi_" + id).html();
    var kode_kepanitiaan = $("#organisasi-kode_kepanitiaan_" + id).html();
    var kedudukan = $("#organisasi-kedudukan_" + id).html();
    var tmt_mulai = $("#organisasi-tmt_mulai_" + id).html();
    var tmt_berakhir = $("#organisasi-tmt_berakhir_" + id).html();

    //set data
    $("#organisasi-kode_bkn_organisasi").val(kode_bkn_organisasi);

    $("#organisasi-nama_organisasi").val(nama_organisasi);
    $("#organisasi-kode_kepanitiaan").val(kode_kepanitiaan).trigger("change");
    $("#organisasi-kedudukan").val(kedudukan);
    $("#organisasi-tmt_mulai").val(tmt_mulai);
    $("#organisasi-tmt_berakhir").val(tmt_berakhir);

    $(".add-new-data.organisasi").addClass("show");
    $(".overlay-bg.organisasi").addClass("show");

    $("#organisasi-btn-simpan").addClass("hidden");
    $("#organisasi-btn-batal").addClass("hidden");

    $("#organisasi-input-alasan").removeClass("hidden");
    $("#organisasi-btn-verifikasi").removeClass("hidden");
    $("#organisasi-btn-tolak").removeClass("hidden");
}

function hapus_organisasi(id) {
    //alert(id);
    swal({
            title: "Hapus data?",
            //icon: "info",
            buttons: true,
            dangerMode: false,
        })
        .then((isConfirm) => {
            if (isConfirm) {

                block_ui("body");
                $.ajax({
                    url: "<?php echo base_url("simpeg/delete_riwayat/organisasi")?>",
                    type: 'post',
                    data: {
                        id: id,
                        id_pegawai: $("#organisasi-id_pegawai_" + id).html(),
                        nip_pegawai: $("#organisasi-nip_pegawai_" + id).html(),
                        "<?=$this->security->get_csrf_token_name();?>": "<?= $this->security->get_csrf_hash();?>",
                    },
                    success: function(data) {
                        console.log(data);

                        swal("Data berhasil dihapus", {
                            icon: "success",
                        });

                        setTimeout(function() {
                            get_riwayat('organisasi');
                        }, 500);
                    },
                    error: function(xhr, status, error) {
                        //swal("Opps","Error","error");
                        console.log(xhr);

                        setTimeout(function() {
                            get_riwayat('organisasi');
                        }, 500);
                    }
                });

            }
        });
}

function verifikasi_hapus_organisasi(id) {
    //alert(id);
    swal({
            title: "Hapus data?",
            //icon: "info",
            buttons: true,
            dangerMode: false,
        })
        .then((isConfirm) => {
            if (isConfirm) {

                block_ui("body");
                $.ajax({
                    url: "<?php echo base_url("simpeg/verif_delete_riwayat/organisasi")?>",
                    type: 'post',
                    data: {
                        id: id,
                        "<?=$this->security->get_csrf_token_name();?>": "<?= $this->security->get_csrf_hash();?>",
                    },
                    success: function(data) {
                        console.log(data);

                        swal("Data berhasil dihapus", {
                            icon: "success",
                        });

                        setTimeout(function() {
                            get_riwayat('organisasi');
                        }, 500);
                    },
                    error: function(xhr, status, error) {
                        //swal("Opps","Error","error");
                        console.log(xhr);

                        setTimeout(function() {
                            get_riwayat('organisasi');
                        }, 500);
                    }
                });

            }
        });
}

function batal_organisasi(id) {
    //alert(id);
    swal({
            title: "Batalkan Pembaruan?",
            //icon: "info",
            buttons: true,
            dangerMode: false,
        })
        .then((isConfirm) => {
            if (isConfirm) {

                block_ui("body");
                $.ajax({
                    url: "<?php echo base_url("simpeg/cancel_riwayat/organisasi")?>",
                    type: 'post',
                    data: {
                        id: id,
                        "<?=$this->security->get_csrf_token_name();?>": "<?= $this->security->get_csrf_hash();?>",
                    },
                    success: function(data) {
                        console.log(data);

                        swal("Data berhasil dihapus", {
                            icon: "success",
                        });

                        setTimeout(function() {
                            get_riwayat('organisasi');
                        }, 500);
                    },
                    error: function(xhr, status, error) {
                        //swal("Opps","Error","error");
                        console.log(xhr);

                        setTimeout(function() {
                            get_riwayat('organisasi');
                        }, 500);
                    }
                });

            }
        });
}

function tambah_organisasi() {
    $("#organisasi-fileframe").attr("src", "");
    $("#organisasi-filelink").html("");

    $("#organisasi-id_update").val("");
    $("#organisasi-id_organisasi").val("");
    $("#organisasi-kode_bkn_organisasi").val("");

    $("#organisasi-nama_organisasi").val("");
    $("#organisasi-kode_kepanitiaan").val("").trigger("change");
    $("#organisasi-kedudukan").val("");
    $("#organisasi-tmt_mulai").val("");
    $("#organisasi-tmt_berakhir").val("");

    $(".add-new-data.organisasi").addClass("show");
    $(".overlay-bg.organisasi").addClass("show");

    $("#organisasi-btn-simpan").removeClass("hidden");
    $("#organisasi-btn-batal").removeClass("hidden");

    $("#organisasi-input-alasan").addClass("hidden");
    $("#organisasi-btn-verifikasi").addClass("hidden");
    $("#organisasi-btn-tolak").addClass("hidden");
}
</script>


<section class="data-list-view-header hidden">
    <!-- RW kepanitiaan -->
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <h4 class="card-title">Riwayat Kepanitiaan <button type="button" onclick="tambah_kepanitiaan();"
                        class="btn btn-sm btn-primary waves-effect waves-light pull-right">Tambah</button></h4>
                <hr />
                <div class="table-responsive">
                    <table class="table table-striped datatable">
                        <thead>
                            <tr>
                                <th>Nama Kepanitiaan</th>
                                <th>Jenis</th>
                                <th>Kedudukan</th>
                                <th>Tahun</th>
                                <th>Bobot Kompetensi</th>
                                <th>SK Nomor</th>
                                <th>SK Tanggal <span class="fa fa-sort-desc"></span></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($kepanitiaan as $row1): $row = $row1; ?>
                            <?php foreach ($dump_kepanitiaan['update'] as $row2): ?>
                            <?php
									if($row1->id_kepanitiaan == $row2->id_kepanitiaan) {
										$row = $row2;
										$row->nama_ref_kepanitiaan = convert_data($ref_kepanitiaan,'kode_kepanitiaan',$row->kode_kepanitiaan,'nama_kepanitiaan');
									}
									?>
                            <?php endforeach ?>
                            <?php foreach ($dump_kepanitiaan['delete'] as $row2): ?>
                            <?php
									if($row1->id_kepanitiaan == $row2->id_kepanitiaan) {
										$row->id_update = $row2->id_update;
										$row->status_verifikasi = $row2->status_verifikasi;
										$row->status_update = $row2->status_update;
										$row->alasan = $row2->alasan;
									}
									?>
                            <?php endforeach ?>
                            <tr class="<?=get_status_riwayat_simpeg($row)?>">
                                <td><?=$row->nama_kepanitiaan?></td>
                                <td><?=$row->nama_ref_kepanitiaan?></td>
                                <td><?=$row->kedudukan?></td>
                                <td><?=$row->tahun?></td>
                                <td><?=$row->bobot_kompetensi?></td>
                                <td><?=$row->sk_nomor?></td>
                                <td><?=tanggal($row->sk_tanggal)?></td>
                                <td>
                                    <div class="badge badge-pill badge-glow badge-light-primary mr-1 mb-1"><?=@$row->status_verifikasi?><?=(@$row->status_update=="DELETE")?" Hapus Data":""?></div>
                                </td>
                                <td>
                                    <?php if (@$row->status_verifikasi == "Ditolak"): ?>
                                    <div class="alert alert-primary alert-validation-msg" role="alert"
                                        style="padding: 0; font-weight: unset;">
                                        <i class="feather icon-info align-middle"></i>
                                        <span><?=$row->alasan?></span>
                                    </div>
                                    <?php endif ?>

                                    <?php if (@$row->status_verifikasi == "Proses" AND @$row->status_update != "DELETE" AND ($this->user_level=="Administrator" OR in_array('kepegawaian', $this->user_privileges))): ?>
                                    <button type="button" onclick="verifikasi_kepanitiaan('<?=$row->id_kepanitiaan?>');"
                                        class="btn btn-success btn-sm mr-1 mb-1">Verifikasi</button>
                                    <?php endif ?>

                                    <?php if (@$row->status_verifikasi == "Proses" AND @$row->status_update == "DELETE" AND ($this->user_level=="Administrator" OR in_array('kepegawaian', $this->user_privileges))): ?>
                                    <button type="button"
                                        onclick="verifikasi_hapus_kepanitiaan('<?=$row->id_update?>');"
                                        class="btn btn-danger btn-sm mr-1 mb-1">Verifikasi Hapus</button>
                                    <div class="alert alert-primary alert-validation-msg" role="alert"
                                        style="padding: 0; font-weight: unset;">
                                        <i class="feather icon-info align-middle"></i>
                                        <span><?=$row->alasan?></span>
                                    </div>
                                    <?php endif ?>

                                    <?php if (@$row->status_verifikasi != "Diterima" AND @$row->status_update != "DELETE"): ?>
                                    <button type="button" onclick="edit_kepanitiaan('<?=$row->id_kepanitiaan?>');"
                                        class="btn btn-success btn-sm mr-1 mb-1">Ubah</button>
                                    <?php endif ?>

                                    <?php if (@$row->status_verifikasi != "Diterima" AND @$row->id_update): ?>
                                    <button type="button" onclick="batal_kepanitiaan('<?=$row->id_update?>');"
                                        class="btn btn-sm btn-outline-dark mr-1 mb-1">Batal</button>
                                    <?php endif ?>

                                    <?php if (@!$row->id_update): ?>
                                    <button type="button" onclick="hapus_kepanitiaan('<?=$row->id_kepanitiaan?>');"
                                        class="btn btn-sm btn-outline-danger mr-1 mb-1">Hapus</button>
                                    <?php endif ?>
                                    <?php if ($row->status != "Y"): ?>
                                    <!-- <button type="button" onclick="aktif_kepanitiaan('<?=$row->id_kepanitiaan?>');" class="btn bg-gradient-primary btn-sm mr-sm-1 mr-1 mb-1">Aktifkan</button> -->
                                    <?php endif ?>

                                    <?php if (isset($row->berkas)): ?>
                                    <a href="<?=base_url()?>data/simpeg/riwayat_kepanitiaan/<?=$row->berkas?>"
                                        target="_blank" class="btn btn-sm btn-light mr-1 mb-1">Lihat Berkas</a>
                                    <?php endif ?>
                                </td>
                            </tr>
                            <?php foreach ($row as $k => $v): ?>
                            <var class="hidden" id="kepanitiaan-<?=$k?>_<?=$row->id_kepanitiaan?>"><?=$v?></var>
                            <?php endforeach ?>
                            <?php endforeach ?>
                            <?php foreach ($dump_kepanitiaan['insert'] as $row1): $row = $row1; ?>
                            <?php 
								$row->nama_ref_kepanitiaan = convert_data($ref_kepanitiaan,'kode_kepanitiaan',$row->kode_kepanitiaan,'nama_kepanitiaan');
								?>
                            <tr class="<?=get_status_riwayat_simpeg($row)?>">
                                <td><?=$row->nama_kepanitiaan?></td>
                                <td><?=$row->nama_ref_kepanitiaan?></td>
                                <td><?=$row->kedudukan?></td>
                                <td><?=$row->tahun?></td>
                                <td><?=$row->bobot_kompetensi?></td>
                                <td><?=$row->sk_nomor?></td>
                                <td><?=tanggal($row->sk_tanggal)?></td>
                                <td>
                                    <div class="badge badge-pill badge-glow badge-light-primary mr-1 mb-1"><?=@$row->status_verifikasi?></div>
                                </td>
                                <td>
                                    <?php if (@$row->status_verifikasi == "Ditolak"): ?>
                                    <div class="alert alert-primary alert-validation-msg" role="alert"
                                        style="padding: 0; font-weight: unset;">
                                        <i class="feather icon-info align-middle"></i>
                                        <span><?=$row->alasan?></span>
                                    </div>
                                    <?php endif ?>

                                    <?php if (@$row->status_verifikasi == "Proses" AND ($this->user_level=="Administrator" OR in_array('kepegawaian', $this->user_privileges))): ?>
                                    <button type="button"
                                        onclick="verifikasi_kepanitiaan('<?=$row->id_update?>_<?=$row->id_kepanitiaan?>');"
                                        class="btn btn-success btn-sm mr-1 mb-1">Verifikasi</button>
                                    <?php endif ?>

                                    <?php if (@$row->status_verifikasi != "Diterima"): ?>
                                    <button type="button"
                                        onclick="edit_kepanitiaan('<?=$row->id_update?>_<?=$row->id_kepanitiaan?>');"
                                        class="btn btn-success btn-sm mr-1 mb-1">Ubah</button>
                                    <?php endif ?>

                                    <?php if (@$row->status_verifikasi != "Diterima" AND @$row->id_update): ?>
                                    <button type="button" onclick="batal_kepanitiaan('<?=$row->id_update?>');"
                                        class="btn btn-sm btn-outline-dark mr-1 mb-1">Batal</button>
                                    <?php endif ?>

                                    <?php if (isset($row->berkas)): ?>
                                    <a href="<?=base_url()?>data/simpeg/riwayat_kepanitiaan/<?=$row->berkas?>"
                                        target="_blank" class="btn btn-sm btn-light mr-1 mb-1">Lihat Berkas</a>
                                    <?php endif ?>
                                </td>
                            </tr>
                            <?php foreach ($row as $k => $v): ?>
                            <var class="hidden"
                                id="kepanitiaan-<?=$k?>_<?=$row->id_update?>_<?=$row->id_kepanitiaan?>"><?=$v?></var>
                            <?php endforeach ?>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- add new sidebar starts -->
    <div class="add-new-data-sidebar">
        <div class="overlay-bg kepanitiaan" onclick="close_sidebar('kepanitiaan')"></div>
        <div class="add-new-data kepanitiaan fileframe hide">
            <button class="btn btn-icon rounded-circle btn-outline-primary" onclick="close_sidebar('kepanitiaan')"
                style="position: absolute; top:13px; left:12px;"><i class="feather icon-x"></i></button>
            <iframe id="kepanitiaan-fileframe" src="" frameborder="0"
                style="overflow: scroll; overflow-x: hidden; overflow-y: scroll; padding:0px;margin:0px; width: 100%; height: 100%;"></iframe>
        </div>
        <div class="add-new-data kepanitiaan" style="overflow-y: auto;">
            <form action="javascript: void(0)" id="form-kepanitiaan" onsubmit="submit_kepanitiaan()"
                enctype="multipart/form-data">
                <input type="hidden" id="kepanitiaan-csrf" name="<?=$this->security->get_csrf_token_name();?>"
                    value="<?= $this->security->get_csrf_hash();?>" />
                <input type="hidden" name="id_update" id="kepanitiaan-id_update" value="" />
                <input type="hidden" name="id_kepanitiaan" id="kepanitiaan-id_kepanitiaan" value="" />
                <input type="hidden" name="id_pegawai" value="<?=$id?>" />
                <input type="hidden" name="nip_pegawai" value="<?=$nip?>" />
                <div class="div mt-2 px-2 d-flex new-data-title justify-content-between">
                    <div>
                        <h4 class="text-uppercase">Riwayat Kepanitiaan</h4>
                    </div>
                    <div class="hide-data-sidebar" onclick="close_sidebar('kepanitiaan')">
                        <i class="feather icon-x"></i>
                    </div>
                </div>
                <div class="data-items pb-3">
                    <div class="data-fields px-2">
                        <div class="row">
                            <!-- <div class="col-sm-12 data-field-col"> -->
                            <!-- <label for="data-name">Kode BKN</label> -->
                            <input type="hidden" name="kode_bkn_kepanitiaan" id="kepanitiaan-kode_bkn_kepanitiaan"
                                class="form-control" placeholder="diisi oleh admin simpeg">
                            <!-- </div> -->
                            <div class="col-sm-12 data-field-col">
                                <label for="data-name">Nama Kepanitiaan</label>
                                <input type="text" name="nama_kepanitiaan" id="kepanitiaan-nama_kepanitiaan"
                                    class="form-control" required="">
                            </div>
                            <div class="col-sm-12 data-field-col">
                                <label for="data-name">Jenis Kepanitiaan</label>
                                <select class="form-control select2" id="kepanitiaan-kode_kepanitiaan"
                                    name="kode_kepanitiaan" required="">
                                    <option value="">-- PILIH --</option>
                                    <?php foreach ($ref_kepanitiaan as $row): ?>
                                    <option value="<?=$row->kode_kepanitiaan?>"><?=$row->nama_kepanitiaan?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="col-sm-12 data-field-col">
                                <label for="data-name">Kedudukan</label>
                                <input type="text" name="kedudukan" id="kepanitiaan-kedudukan" class="form-control"
                                    placeholder="contoh: ketua" required="">
                            </div>
                            <div class="col-sm-6 data-field-col">
                                <label for="data-name">Tahun</label>
                                <input type="number" name="tahun" id="kepanitiaan-tahun" class="form-control"
                                    required="">
                            </div>
                            <div class="col-sm-6 data-field-col">
                                <label for="data-name">Bobot Kompetensi</label>
                                <input type="number" name="bobot_kompetensi" id="kepanitiaan-bobot_kompetensi"
                                    class="form-control" required="">
                            </div>
                            <div class="col-sm-12 data-field-col">
                                <label for="data-name">Nomor SK</label>
                                <input type="text" name="sk_nomor" id="kepanitiaan-sk_nomor" class="form-control"
                                    required="">
                            </div>
                            <div class="col-sm-12 data-field-col">
                                <label for="data-name">Tanggal SK</label>
                                <input type="date" name="sk_tanggal" id="kepanitiaan-sk_tanggal" class="form-control"
                                    required="">
                            </div>
                            <div class="col-sm-12 data-field-col">
                                <fieldset class="form-group">
                                    <label for="data-name">Upload Berkas</label>
                                    <div class="custom-file">
                                        <input type="file" name="berkas" class="custom-file-input"
                                            id="kepanitiaan-berkas" accept="application/pdf">
                                        <label class="custom-file-label" for="kepanitiaan-berkas">Pilih Berkas
                                            PDF</label>
                                    </div>
                                    <a id="kepanitiaan-filelink" href="" target="_blank"></a>
                                </fieldset>
                            </div>
                            <div id="kepanitiaan-input-alasan" class="col-sm-12 data-field-col">
                                <label for="data-name">Alasan Penolakan</label>
                                <textarea name="alasan" id="kepanitiaan-alasan" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="add-data-footer d-flex justify-content-around px-3 mt-2 pb-3">
                    <input type="hidden" id="kepanitiaan-input-verifikasi" name="verifikasi">
                    <div class="add-data-btn">
                        <button id="kepanitiaan-btn-simpan" type="submit" class="btn btn-primary"
                            onclick="$('#kepanitiaan-input-verifikasi').val('')">Simpan</button>
                        <button id="kepanitiaan-btn-verifikasi" type="submit" class="btn btn-primary"
                            onclick="$('#kepanitiaan-input-verifikasi').val('verifikasi')">Verifikasi</button>
                    </div>
                    <div class="cancel-data-btn">
                        <button id="kepanitiaan-btn-batal" type="button" class="btn btn-outline-danger"
                            onclick="close_sidebar('kepanitiaan')">Batal</button>
                        <button id="kepanitiaan-btn-tolak" type="submit" class="btn btn-outline-danger"
                            onclick="$('#kepanitiaan-input-verifikasi').val('tolak')">Tolak</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- add new sidebar ends -->

<script>
function submit_kepanitiaan() {
    var formData = new FormData($('#form-kepanitiaan')[0]);
    var _csrfName = $('input#kepanitiaan-csrf').attr('name');
    var _csrfValue = $('input#kepanitiaan-csrf').val();
    var file_data = $('#kepanitiaan-berkas').prop('files')[0];
    formData.append('berkas', file_data);
    formData.append(_csrfName, _csrfValue);

    block_ui("body");
    $.ajax({
        url: "<?php echo base_url("simpeg/submit_riwayat/kepanitiaan")?>",
        type: 'post',
        data: formData,
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
            console.log(data);

            swal("Data berhasil diupdate", data.error, {
                icon: "success",
            });

            setTimeout(function() {
                get_riwayat('organisasi');
            }, 500);
        },
        error: function(xhr, status, error) {
            swal("Opps", "Error", "error");
            console.log(xhr);

            setTimeout(function() {
                get_riwayat('organisasi');
            }, 500);
        }
    });
}

function edit_kepanitiaan(id) {
    //alert(id);
    open_fileframe('kepanitiaan', $("#kepanitiaan-berkas_" + id).html())
    $("#kepanitiaan-filelink").html("");
    $("#kepanitiaan-filelink").html($("#kepanitiaan-berkas_" + id).html());
    $("#kepanitiaan-filelink").attr("href", '<?=base_url()?>data/simpeg/riwayat_kepanitiaan/' + $(
        "#kepanitiaan-berkas_" + id).html());

    $("#kepanitiaan-id_update").val($("#kepanitiaan-id_update_" + id).html());
    $("#kepanitiaan-id_kepanitiaan").val($("#kepanitiaan-id_kepanitiaan_" + id).html());
    //ambil data
    var kode_bkn_kepanitiaan = $("#kepanitiaan-kode_bkn_kepanitiaan_" + id).html();

    var nama_kepanitiaan = $("#kepanitiaan-nama_kepanitiaan_" + id).html();
    var kode_kepanitiaan = $("#kepanitiaan-kode_kepanitiaan_" + id).html();
    var kedudukan = $("#kepanitiaan-kedudukan_" + id).html();
    var tahun = $("#kepanitiaan-tahun_" + id).html();
    var bobot_kompetensi = $("#kepanitiaan-bobot_kompetensi_" + id).html();

    var sk_nomor = $("#kepanitiaan-sk_nomor_" + id).html();
    var sk_tanggal = $("#kepanitiaan-sk_tanggal_" + id).html();

    //set data
    $("#kepanitiaan-kode_bkn_kepanitiaan").val(kode_bkn_kepanitiaan);

    $("#kepanitiaan-nama_kepanitiaan").val(nama_kepanitiaan);
    $("#kepanitiaan-kode_kepanitiaan").val(kode_kepanitiaan).trigger("change");
    $("#kepanitiaan-kedudukan").val(kedudukan);
    $("#kepanitiaan-tahun").val(tahun);
    $("#kepanitiaan-bobot_kompetensi").val(bobot_kompetensi);

    $("#kepanitiaan-sk_nomor").val(sk_nomor);
    $("#kepanitiaan-sk_tanggal").val(sk_tanggal);

    $(".add-new-data.kepanitiaan").addClass("show");
    $(".overlay-bg.kepanitiaan").addClass("show");

    $("#kepanitiaan-btn-simpan").removeClass("hidden");
    $("#kepanitiaan-btn-batal").removeClass("hidden");

    $("#kepanitiaan-input-alasan").addClass("hidden");
    $("#kepanitiaan-btn-verifikasi").addClass("hidden");
    $("#kepanitiaan-btn-tolak").addClass("hidden");
}

function verifikasi_kepanitiaan(id) {
    //alert(id);
    open_fileframe('kepanitiaan', $("#kepanitiaan-berkas_" + id).html())
    $("#kepanitiaan-filelink").html("");
    $("#kepanitiaan-filelink").html($("#kepanitiaan-berkas_" + id).html());
    $("#kepanitiaan-filelink").attr("href", '<?=base_url()?>data/simpeg/riwayat_kepanitiaan/' + $(
        "#kepanitiaan-berkas_" + id).html());

    $("#kepanitiaan-id_update").val($("#kepanitiaan-id_update_" + id).html());
    $("#kepanitiaan-id_kepanitiaan").val($("#kepanitiaan-id_kepanitiaan_" + id).html());
    //ambil data
    var kode_bkn_kepanitiaan = $("#kepanitiaan-kode_bkn_kepanitiaan_" + id).html();

    var nama_kepanitiaan = $("#kepanitiaan-nama_kepanitiaan_" + id).html();
    var kode_kepanitiaan = $("#kepanitiaan-kode_kepanitiaan_" + id).html();
    var kedudukan = $("#kepanitiaan-kedudukan_" + id).html();
    var tahun = $("#kepanitiaan-tahun_" + id).html();
    var bobot_kompetensi = $("#kepanitiaan-bobot_kompetensi_" + id).html();

    var sk_nomor = $("#kepanitiaan-sk_nomor_" + id).html();
    var sk_tanggal = $("#kepanitiaan-sk_tanggal_" + id).html();

    //set data
    $("#kepanitiaan-kode_bkn_kepanitiaan").val(kode_bkn_kepanitiaan);

    $("#kepanitiaan-nama_kepanitiaan").val(nama_kepanitiaan);
    $("#kepanitiaan-kode_kepanitiaan").val(kode_kepanitiaan).trigger("change");
    $("#kepanitiaan-kedudukan").val(kedudukan);
    $("#kepanitiaan-tahun").val(tahun);
    $("#kepanitiaan-bobot_kompetensi").val(bobot_kompetensi);

    $("#kepanitiaan-sk_nomor").val(sk_nomor);
    $("#kepanitiaan-sk_tanggal").val(sk_tanggal);

    $(".add-new-data.kepanitiaan").addClass("show");
    $(".overlay-bg.kepanitiaan").addClass("show");

    $("#kepanitiaan-btn-simpan").addClass("hidden");
    $("#kepanitiaan-btn-batal").addClass("hidden");

    $("#kepanitiaan-input-alasan").removeClass("hidden");
    $("#kepanitiaan-btn-verifikasi").removeClass("hidden");
    $("#kepanitiaan-btn-tolak").removeClass("hidden");
}

function hapus_kepanitiaan(id) {
    //alert(id);
    swal({
            title: "Hapus data?",
            //icon: "info",
            buttons: true,
            dangerMode: false,
        })
        .then((isConfirm) => {
            if (isConfirm) {

                block_ui("body");
                $.ajax({
                    url: "<?php echo base_url("simpeg/delete_riwayat/kepanitiaan")?>",
                    type: 'post',
                    data: {
                        id: id,
                        id_pegawai: $("#kepanitiaan-id_pegawai_" + id).html(),
                        nip_pegawai: $("#kepanitiaan-nip_pegawai_" + id).html(),
                        "<?=$this->security->get_csrf_token_name();?>": "<?= $this->security->get_csrf_hash();?>",
                    },
                    success: function(data) {
                        console.log(data);

                        swal("Data berhasil dihapus", {
                            icon: "success",
                        });

                        setTimeout(function() {
                            get_riwayat('organisasi');
                        }, 500);
                    },
                    error: function(xhr, status, error) {
                        //swal("Opps","Error","error");
                        console.log(xhr);

                        setTimeout(function() {
                            get_riwayat('organisasi');
                        }, 500);
                    }
                });

            }
        });
}

function verifikasi_hapus_kepanitiaan(id) {
    //alert(id);
    swal({
            title: "Hapus data?",
            //icon: "info",
            buttons: true,
            dangerMode: false,
        })
        .then((isConfirm) => {
            if (isConfirm) {

                block_ui("body");
                $.ajax({
                    url: "<?php echo base_url("simpeg/verif_delete_riwayat/kepanitiaan")?>",
                    type: 'post',
                    data: {
                        id: id,
                        "<?=$this->security->get_csrf_token_name();?>": "<?= $this->security->get_csrf_hash();?>",
                    },
                    success: function(data) {
                        console.log(data);

                        swal("Data berhasil dihapus", {
                            icon: "success",
                        });

                        setTimeout(function() {
                            get_riwayat('organisasi');
                        }, 500);
                    },
                    error: function(xhr, status, error) {
                        //swal("Opps","Error","error");
                        console.log(xhr);

                        setTimeout(function() {
                            get_riwayat('organisasi');
                        }, 500);
                    }
                });

            }
        });
}

function batal_kepanitiaan(id) {
    //alert(id);
    swal({
            title: "Batalkan Pembaruan?",
            //icon: "info",
            buttons: true,
            dangerMode: false,
        })
        .then((isConfirm) => {
            if (isConfirm) {

                block_ui("body");
                $.ajax({
                    url: "<?php echo base_url("simpeg/cancel_riwayat/kepanitiaan")?>",
                    type: 'post',
                    data: {
                        id: id,
                        "<?=$this->security->get_csrf_token_name();?>": "<?= $this->security->get_csrf_hash();?>",
                    },
                    success: function(data) {
                        console.log(data);

                        swal("Data berhasil dihapus", {
                            icon: "success",
                        });

                        setTimeout(function() {
                            get_riwayat('organisasi');
                        }, 500);
                    },
                    error: function(xhr, status, error) {
                        //swal("Opps","Error","error");
                        console.log(xhr);

                        setTimeout(function() {
                            get_riwayat('organisasi');
                        }, 500);
                    }
                });

            }
        });
}

function tambah_kepanitiaan() {
    $("#kepanitiaan-fileframe").attr("src", "");
    $("#kepanitiaan-filelink").html("");

    $("#kepanitiaan-id_update").val("");
    $("#kepanitiaan-id_kepanitiaan").val("");
    $("#kepanitiaan-kode_bkn_kepanitiaan").val("");

    $("#kepanitiaan-nama_kepanitiaan").val("");
    $("#kepanitiaan-kode_kepanitiaan").val("").trigger("change");
    $("#kepanitiaan-kedudukan").val("");
    $("#kepanitiaan-tahun").val("");
    $("#kepanitiaan-bobot_kompetensi").val("");

    $("#kepanitiaan-sk_nomor").val("");
    $("#kepanitiaan-sk_tanggal").val("");

    $(".add-new-data.kepanitiaan").addClass("show");
    $(".overlay-bg.kepanitiaan").addClass("show");

    $("#kepanitiaan-btn-simpan").removeClass("hidden");
    $("#kepanitiaan-btn-batal").removeClass("hidden");

    $("#kepanitiaan-input-alasan").addClass("hidden");
    $("#kepanitiaan-btn-verifikasi").addClass("hidden");
    $("#kepanitiaan-btn-tolak").addClass("hidden");
}
</script>


<section class="data-list-view-header">
    <!-- RW penugasan -->
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <h4 class="card-title">Riwayat Penugasan <button type="button" onclick="tambah_penugasan();"
                        class="btn btn-sm btn-primary waves-effect waves-light pull-right">Tambah</button></h4>
                <hr />
                <div class="table-responsive">
                    <table class="table table-striped datatable">
                        <thead>
                            <tr>
                                <th>Nama Penugasan</th>
                                <th>Level</th>
                                <th>Jenis</th>
                                <th>Kedudukan</th>
                                <th>Tahun</th>
                                <th>SK Nomor</th>
                                <th>SK Tanggal <span class="fa fa-sort-desc"></span></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($penugasan as $row1): $row = $row1; ?>
                            <?php foreach ($dump_penugasan['update'] as $row2): ?>
                            <?php
									if($row1->id_penugasan == $row2->id_penugasan) {
										$row = $row2;
										$row->nama_ref_penugasan = convert_data($ref_penugasan,'kode_penugasan',$row->kode_penugasan,'nama_penugasan');
									}
									?>
                            <?php endforeach ?>
                            <?php foreach ($dump_penugasan['delete'] as $row2): ?>
                            <?php
									if($row1->id_penugasan == $row2->id_penugasan) {
										$row->id_update = $row2->id_update;
										$row->status_verifikasi = $row2->status_verifikasi;
										$row->status_update = $row2->status_update;
										$row->alasan = $row2->alasan;
									}
									?>
                            <?php endforeach ?>
                            <tr class="<?=get_status_riwayat_simpeg($row)?>">
                                <td><?=$row->nama_penugasan?></td>
                                <td><?=$row->nama_ref_penugasan?></td>
                                <td><?=$row->jenis_penugasan?></td>
                                <td><?=$row->kedudukan?></td>
                                <td><?=$row->tahun?></td>
                                <td><?=$row->sk_nomor?></td>
                                <td><?=tanggal($row->sk_tanggal)?></td>
                                <td>
                                    <div class="badge badge-pill badge-glow badge-light-primary mr-1 mb-1"><?=@$row->status_verifikasi?><?=(@$row->status_update=="DELETE")?" Hapus Data":""?></div>
                                </td>
                                <td>
                                    <?php if (@$row->status_verifikasi == "Ditolak"): ?>
                                    <div class="alert alert-primary alert-validation-msg" role="alert"
                                        style="padding: 0; font-weight: unset;">
                                        <i class="feather icon-info align-middle"></i>
                                        <span><?=$row->alasan?></span>
                                    </div>
                                    <?php endif ?>

                                    <?php if (@$row->status_verifikasi == "Proses" AND @$row->status_update != "DELETE" AND ($this->user_level=="Administrator" OR in_array('kepegawaian', $this->user_privileges))): ?>
                                    <button type="button" onclick="verifikasi_penugasan('<?=$row->id_penugasan?>');"
                                        class="btn btn-success btn-sm mr-1 mb-1">Verifikasi</button>
                                    <?php endif ?>

                                    <?php if (@$row->status_verifikasi == "Proses" AND @$row->status_update == "DELETE" AND ($this->user_level=="Administrator" OR in_array('kepegawaian', $this->user_privileges))): ?>
                                    <button type="button" onclick="verifikasi_hapus_penugasan('<?=$row->id_update?>');"
                                        class="btn btn-danger btn-sm mr-1 mb-1">Verifikasi Hapus</button>
                                    <div class="alert alert-primary alert-validation-msg" role="alert"
                                        style="padding: 0; font-weight: unset;">
                                        <i class="feather icon-info align-middle"></i>
                                        <span><?=$row->alasan?></span>
                                    </div>
                                    <?php endif ?>

                                    <?php if (@$row->status_verifikasi != "Diterima" AND @$row->status_update != "DELETE"): ?>
                                    <button type="button" onclick="edit_penugasan('<?=$row->id_penugasan?>');"
                                        class="btn btn-success btn-sm mr-1 mb-1">Ubah</button>
                                    <?php endif ?>

                                    <?php if (@$row->status_verifikasi != "Diterima" AND @$row->id_update): ?>
                                    <button type="button" onclick="batal_penugasan('<?=$row->id_update?>');"
                                        class="btn btn-sm btn-outline-dark mr-1 mb-1">Batal</button>
                                    <?php endif ?>

                                    <?php if (@!$row->id_update): ?>
                                    <button type="button" onclick="hapus_penugasan('<?=$row->id_penugasan?>');"
                                        class="btn btn-sm btn-outline-danger mr-1 mb-1">Hapus</button>
                                    <?php endif ?>
                                    <?php if ($row->status != "Y"): ?>
                                    <!-- <button type="button" onclick="aktif_penugasan('<?=$row->id_penugasan?>');" class="btn bg-gradient-primary btn-sm mr-sm-1 mr-1 mb-1">Aktifkan</button> -->
                                    <?php endif ?>

                                    <?php if (isset($row->berkas)): ?>
                                    <a href="<?=base_url()?>data/simpeg/riwayat_penugasan/<?=$row->berkas?>"
                                        target="_blank" class="btn btn-sm btn-light mr-1 mb-1">Lihat Berkas</a>
                                    <?php endif ?>
                                </td>
                            </tr>
                            <?php foreach ($row as $k => $v): ?>
                            <var class="hidden" id="penugasan-<?=$k?>_<?=$row->id_penugasan?>"><?=$v?></var>
                            <?php endforeach ?>
                            <?php endforeach ?>
                            <?php foreach ($dump_penugasan['insert'] as $row1): $row = $row1; ?>
                            <?php 
								$row->nama_ref_penugasan = convert_data($ref_penugasan,'kode_penugasan',$row->kode_penugasan,'nama_penugasan');
								?>
                            <tr class="<?=get_status_riwayat_simpeg($row)?>">
                                <td><?=$row->nama_penugasan?></td>
                                <td><?=$row->nama_ref_penugasan?></td>
                                <td><?=$row->jenis_penugasan?></td>
                                <td><?=$row->kedudukan?></td>
                                <td><?=$row->tahun?></td>
                                <td><?=$row->sk_nomor?></td>
                                <td><?=tanggal($row->sk_tanggal)?></td>
                                <td>
                                    <div class="badge badge-pill badge-glow badge-light-primary mr-1 mb-1"><?=@$row->status_verifikasi?></div>
                                </td>
                                <td>
                                    <?php if (@$row->status_verifikasi == "Ditolak"): ?>
                                    <div class="alert alert-primary alert-validation-msg" role="alert"
                                        style="padding: 0; font-weight: unset;">
                                        <i class="feather icon-info align-middle"></i>
                                        <span><?=$row->alasan?></span>
                                    </div>
                                    <?php endif ?>

                                    <?php if (@$row->status_verifikasi == "Proses" AND ($this->user_level=="Administrator" OR in_array('kepegawaian', $this->user_privileges))): ?>
                                    <button type="button"
                                        onclick="verifikasi_penugasan('<?=$row->id_update?>_<?=$row->id_penugasan?>');"
                                        class="btn btn-success btn-sm mr-1 mb-1">Verifikasi</button>
                                    <?php endif ?>

                                    <?php if (@$row->status_verifikasi != "Diterima"): ?>
                                    <button type="button"
                                        onclick="edit_penugasan('<?=$row->id_update?>_<?=$row->id_penugasan?>');"
                                        class="btn btn-success btn-sm mr-1 mb-1">Ubah</button>
                                    <?php endif ?>

                                    <?php if (@$row->status_verifikasi != "Diterima" AND @$row->id_update): ?>
                                    <button type="button" onclick="batal_penugasan('<?=$row->id_update?>');"
                                        class="btn btn-sm btn-outline-dark mr-1 mb-1">Batal</button>
                                    <?php endif ?>

                                    <?php if (isset($row->berkas)): ?>
                                    <a href="<?=base_url()?>data/simpeg/riwayat_penugasan/<?=$row->berkas?>"
                                        target="_blank" class="btn btn-sm btn-light mr-1 mb-1">Lihat Berkas</a>
                                    <?php endif ?>
                                </td>
                            </tr>
                            <?php foreach ($row as $k => $v): ?>
                            <var class="hidden"
                                id="penugasan-<?=$k?>_<?=$row->id_update?>_<?=$row->id_penugasan?>"><?=$v?></var>
                            <?php endforeach ?>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- add new sidebar starts -->
    <div class="add-new-data-sidebar">
        <div class="overlay-bg penugasan" onclick="close_sidebar('penugasan')"></div>
        <div class="add-new-data penugasan fileframe hide">
            <button class="btn btn-icon rounded-circle btn-outline-primary" onclick="close_sidebar('penugasan')"
                style="position: absolute; top:13px; left:12px;"><i class="feather icon-x"></i></button>
            <iframe id="penugasan-fileframe" src="" frameborder="0"
                style="overflow: scroll; overflow-x: hidden; overflow-y: scroll; padding:0px;margin:0px; width: 100%; height: 100%;"></iframe>
        </div>
        <div class="add-new-data penugasan" style="overflow-y: auto;">
            <form action="javascript: void(0)" id="form-penugasan" onsubmit="submit_penugasan()"
                enctype="multipart/form-data">
                <input type="hidden" id="penugasan-csrf" name="<?=$this->security->get_csrf_token_name();?>"
                    value="<?= $this->security->get_csrf_hash();?>" />
                <input type="hidden" name="id_update" id="penugasan-id_update" value="" />
                <input type="hidden" name="id_penugasan" id="penugasan-id_penugasan" value="" />
                <input type="hidden" name="id_pegawai" value="<?=$id?>" />
                <input type="hidden" name="nip_pegawai" value="<?=$nip?>" />
                <div class="div mt-2 px-2 d-flex new-data-title justify-content-between">
                    <div>
                        <h4 class="text-uppercase">Riwayat Penugasan</h4>
                    </div>
                    <div class="hide-data-sidebar" onclick="close_sidebar('penugasan')">
                        <i class="feather icon-x"></i>
                    </div>
                </div>
                <div class="data-items pb-3">
                    <div class="data-fields px-2">
                        <div class="row">
                            <div class="col-sm-12 data-field-col">
                                <div class="alert alert-primary">
                                    <i class="feather icon-info mr-1 align-middle"></i> Penugasan yang diinputkan adalah
                                    penugasan 1 tahun terakhir
                                </div>
                            </div>
                            <!-- <div class="col-sm-12 data-field-col"> -->
                            <!-- <label for="data-name">Kode BKN</label> -->
                            <input type="hidden" name="kode_bkn_penugasan" id="penugasan-kode_bkn_penugasan"
                                class="form-control" placeholder="diisi oleh admin simpeg">
                            <!-- </div> -->
                            <div class="col-sm-12 data-field-col">
                                <label for="data-name">Nama Penugasan</label>
                                <input type="text" name="nama_penugasan" id="penugasan-nama_penugasan"
                                    class="form-control" required="">
                            </div>
                            <div class="col-sm-12 data-field-col">
                                <label for="data-name">Level Penugasan</label>
                                <select class="form-control select2" id="penugasan-kode_penugasan" name="kode_penugasan"
                                    required="">
                                    <option value="">-- PILIH --</option>
                                    <?php foreach ($ref_penugasan as $row): ?>
                                    <option value="<?=$row->kode_penugasan?>"><?=$row->nama_penugasan?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="col-sm-12 data-field-col">
                                <label for="data-name">Jenis Penugasan</label>
                            </div>
                            <div class="col-sm-6 data-field-col">
                                <div class="vs-radio-con">
                                    <input type="radio" name="jenis_penugasan" id="penugasan-mandiri" value="Mandiri">
                                    <span class="vs-radio">
                                        <span class="vs-radio--border"></span>
                                        <span class="vs-radio--circle"></span>
                                    </span>
                                    <span class="">Mandiri</span>
                                </div>
                            </div>
                            <div class="col-sm-6 data-field-col">
                                <div class="vs-radio-con">
                                    <input type="radio" name="jenis_penugasan" id="penugasan-tim" value="Tim">
                                    <span class="vs-radio">
                                        <span class="vs-radio--border"></span>
                                        <span class="vs-radio--circle"></span>
                                    </span>
                                    <span class="">Tim</span>
                                </div>
                            </div>
                            <div class="col-sm-12 data-field-col">
                                <label for="data-name">Kedudukan</label>
                                <input type="text" name="kedudukan" id="penugasan-kedudukan" class="form-control"
                                    placeholder="contoh: ketua" required="">
                            </div>
                            <div class="col-sm-12 data-field-col">
                                <label for="data-name">Tahun</label>
                                <input type="number" name="tahun" id="penugasan-tahun" class="form-control" required="">
                            </div>
                            <div class="col-sm-12 data-field-col">
                                <label for="data-name">Nomor SK/SP</label>
                                <input type="text" name="sk_nomor" id="penugasan-sk_nomor" class="form-control"
                                    required="">
                            </div>
                            <div class="col-sm-12 data-field-col">
                                <label for="data-name">Tanggal SK/SP</label>
                                <input type="date" name="sk_tanggal" id="penugasan-sk_tanggal" class="form-control"
                                    required="">
                            </div>
                            <div class="col-sm-12 data-field-col">
                                <fieldset class="form-group">
                                    <label for="data-name">Upload Berkas</label>
                                    <div class="custom-file">
                                        <input type="file" name="berkas" class="custom-file-input" id="penugasan-berkas"
                                            accept="application/pdf">
                                        <label class="custom-file-label" for="penugasan-berkas">Pilih Berkas PDF</label>
                                    </div>
                                    <a id="penugasan-filelink" href="" target="_blank"></a>
                                </fieldset>
                            </div>
                            <div id="penugasan-input-alasan" class="col-sm-12 data-field-col">
                                <label for="data-name">Alasan Penolakan</label>
                                <textarea name="alasan" id="penugasan-alasan" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="add-data-footer d-flex justify-content-around px-3 mt-2 pb-3">
                    <input type="hidden" id="penugasan-input-verifikasi" name="verifikasi">
                    <div class="add-data-btn">
                        <button id="penugasan-btn-simpan" type="submit" class="btn btn-primary"
                            onclick="$('#penugasan-input-verifikasi').val('')">Simpan</button>
                        <button id="penugasan-btn-verifikasi" type="submit" class="btn btn-primary"
                            onclick="$('#penugasan-input-verifikasi').val('verifikasi')">Verifikasi</button>
                    </div>
                    <div class="cancel-data-btn">
                        <button id="penugasan-btn-batal" type="button" class="btn btn-outline-danger"
                            onclick="close_sidebar('penugasan')">Batal</button>
                        <button id="penugasan-btn-tolak" type="submit" class="btn btn-outline-danger"
                            onclick="$('#penugasan-input-verifikasi').val('tolak')">Tolak</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- add new sidebar ends -->

<script>
function submit_penugasan() {
    var formData = new FormData($('#form-penugasan')[0]);
    var _csrfName = $('input#penugasan-csrf').attr('name');
    var _csrfValue = $('input#penugasan-csrf').val();
    var file_data = $('#penugasan-berkas').prop('files')[0];
    formData.append('berkas', file_data);
    formData.append(_csrfName, _csrfValue);

    block_ui("body");
    $.ajax({
        url: "<?php echo base_url("simpeg/submit_riwayat/penugasan")?>",
        type: 'post',
        data: formData,
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
            console.log(data);

            swal("Data berhasil diupdate", data.error, {
                icon: "success",
            });

            setTimeout(function() {
                get_riwayat('organisasi');
            }, 500);
        },
        error: function(xhr, status, error) {
            swal("Opps", "Error", "error");
            console.log(xhr);

            setTimeout(function() {
                get_riwayat('organisasi');
            }, 500);
        }
    });
}

function edit_penugasan(id) {
    //alert(id);
    open_fileframe('penugasan', $("#penugasan-berkas_" + id).html())
    $("#penugasan-filelink").html("");
    $("#penugasan-filelink").html($("#penugasan-berkas_" + id).html());
    $("#penugasan-filelink").attr("href", '<?=base_url()?>data/simpeg/riwayat_penugasan/' + $("#penugasan-berkas_" + id)
        .html());

    $("#penugasan-id_update").val($("#penugasan-id_update_" + id).html());
    $("#penugasan-id_penugasan").val($("#penugasan-id_penugasan_" + id).html());
    //ambil data
    var kode_bkn_penugasan = $("#penugasan-kode_bkn_penugasan_" + id).html();

    var nama_penugasan = $("#penugasan-nama_penugasan_" + id).html();
    var kode_penugasan = $("#penugasan-kode_penugasan_" + id).html();
    var jenis_penugasan = $("#penugasan-jenis_penugasan_" + id).html();
    var kedudukan = $("#penugasan-kedudukan_" + id).html();
    var tahun = $("#penugasan-tahun_" + id).html();
    // var bobot_kompetensi = $("#penugasan-bobot_kompetensi_"+id).html();

    var sk_nomor = $("#penugasan-sk_nomor_" + id).html();
    var sk_tanggal = $("#penugasan-sk_tanggal_" + id).html();

    //set data
    $("#penugasan-kode_bkn_penugasan").val(kode_bkn_penugasan);

    $("#penugasan-nama_penugasan").val(nama_penugasan);
    $("#penugasan-kode_penugasan").val(kode_penugasan).trigger("change");
    $("#penugasan-" + jenis_penugasan.toLowerCase()).trigger("click");
    $("#penugasan-kedudukan").val(kedudukan);
    $("#penugasan-tahun").val(tahun);
    // $("#penugasan-bobot_kompetensi").val(bobot_kompetensi);

    $("#penugasan-sk_nomor").val(sk_nomor);
    $("#penugasan-sk_tanggal").val(sk_tanggal);

    $(".add-new-data.penugasan").addClass("show");
    $(".overlay-bg.penugasan").addClass("show");

    $("#penugasan-btn-simpan").removeClass("hidden");
    $("#penugasan-btn-batal").removeClass("hidden");

    $("#penugasan-input-alasan").addClass("hidden");
    $("#penugasan-btn-verifikasi").addClass("hidden");
    $("#penugasan-btn-tolak").addClass("hidden");
}

function verifikasi_penugasan(id) {
    //alert(id);
    open_fileframe('penugasan', $("#penugasan-berkas_" + id).html())
    $("#penugasan-filelink").html("");
    $("#penugasan-filelink").html($("#penugasan-berkas_" + id).html());
    $("#penugasan-filelink").attr("href", '<?=base_url()?>data/simpeg/riwayat_penugasan/' + $("#penugasan-berkas_" + id)
        .html());

    $("#penugasan-id_update").val($("#penugasan-id_update_" + id).html());
    $("#penugasan-id_penugasan").val($("#penugasan-id_penugasan_" + id).html());
    //ambil data
    var kode_bkn_penugasan = $("#penugasan-kode_bkn_penugasan_" + id).html();

    var nama_penugasan = $("#penugasan-nama_penugasan_" + id).html();
    var kode_penugasan = $("#penugasan-kode_penugasan_" + id).html();
    var jenis_penugasan = $("#penugasan-jenis_penugasan_" + id).html();
    var kedudukan = $("#penugasan-kedudukan_" + id).html();
    var tahun = $("#penugasan-tahun_" + id).html();
    // var bobot_kompetensi = $("#penugasan-bobot_kompetensi_"+id).html();

    var sk_nomor = $("#penugasan-sk_nomor_" + id).html();
    var sk_tanggal = $("#penugasan-sk_tanggal_" + id).html();

    //set data
    $("#penugasan-kode_bkn_penugasan").val(kode_bkn_penugasan);

    $("#penugasan-nama_penugasan").val(nama_penugasan);
    $("#penugasan-kode_penugasan").val(kode_penugasan).trigger("change");
    $("#penugasan-" + jenis_penugasan.toLowerCase()).trigger("click");
    $("#penugasan-kedudukan").val(kedudukan);
    $("#penugasan-tahun").val(tahun);
    // $("#penugasan-bobot_kompetensi").val(bobot_kompetensi);

    $("#penugasan-sk_nomor").val(sk_nomor);
    $("#penugasan-sk_tanggal").val(sk_tanggal);

    $(".add-new-data.penugasan").addClass("show");
    $(".overlay-bg.penugasan").addClass("show");

    $("#penugasan-btn-simpan").addClass("hidden");
    $("#penugasan-btn-batal").addClass("hidden");

    $("#penugasan-input-alasan").removeClass("hidden");
    $("#penugasan-btn-verifikasi").removeClass("hidden");
    $("#penugasan-btn-tolak").removeClass("hidden");
}

function hapus_penugasan(id) {
    //alert(id);
    swal({
            title: "Hapus data?",
            //icon: "info",
            buttons: true,
            dangerMode: false,
        })
        .then((isConfirm) => {
            if (isConfirm) {

                block_ui("body");
                $.ajax({
                    url: "<?php echo base_url("simpeg/delete_riwayat/penugasan")?>",
                    type: 'post',
                    data: {
                        id: id,
                        id_pegawai: $("#penugasan-id_pegawai_" + id).html(),
                        nip_pegawai: $("#penugasan-nip_pegawai_" + id).html(),
                        "<?=$this->security->get_csrf_token_name();?>": "<?= $this->security->get_csrf_hash();?>",
                    },
                    success: function(data) {
                        console.log(data);

                        swal("Data berhasil dihapus", {
                            icon: "success",
                        });

                        setTimeout(function() {
                            get_riwayat('organisasi');
                        }, 500);
                    },
                    error: function(xhr, status, error) {
                        //swal("Opps","Error","error");
                        console.log(xhr);

                        setTimeout(function() {
                            get_riwayat('organisasi');
                        }, 500);
                    }
                });

            }
        });
}

function verifikasi_hapus_penugasan(id) {
    //alert(id);
    swal({
            title: "Hapus data?",
            //icon: "info",
            buttons: true,
            dangerMode: false,
        })
        .then((isConfirm) => {
            if (isConfirm) {

                block_ui("body");
                $.ajax({
                    url: "<?php echo base_url("simpeg/verif_delete_riwayat/penugasan")?>",
                    type: 'post',
                    data: {
                        id: id,
                        "<?=$this->security->get_csrf_token_name();?>": "<?= $this->security->get_csrf_hash();?>",
                    },
                    success: function(data) {
                        console.log(data);

                        swal("Data berhasil dihapus", {
                            icon: "success",
                        });

                        setTimeout(function() {
                            get_riwayat('organisasi');
                        }, 500);
                    },
                    error: function(xhr, status, error) {
                        //swal("Opps","Error","error");
                        console.log(xhr);

                        setTimeout(function() {
                            get_riwayat('organisasi');
                        }, 500);
                    }
                });

            }
        });
}

function batal_penugasan(id) {
    //alert(id);
    swal({
            title: "Batalkan Pembaruan?",
            //icon: "info",
            buttons: true,
            dangerMode: false,
        })
        .then((isConfirm) => {
            if (isConfirm) {

                block_ui("body");
                $.ajax({
                    url: "<?php echo base_url("simpeg/cancel_riwayat/penugasan")?>",
                    type: 'post',
                    data: {
                        id: id,
                        "<?=$this->security->get_csrf_token_name();?>": "<?= $this->security->get_csrf_hash();?>",
                    },
                    success: function(data) {
                        console.log(data);

                        swal("Data berhasil dihapus", {
                            icon: "success",
                        });

                        setTimeout(function() {
                            get_riwayat('organisasi');
                        }, 500);
                    },
                    error: function(xhr, status, error) {
                        //swal("Opps","Error","error");
                        console.log(xhr);

                        setTimeout(function() {
                            get_riwayat('organisasi');
                        }, 500);
                    }
                });

            }
        });
}

function tambah_penugasan() {
    $("#penugasan-fileframe").attr("src", "");
    $("#penugasan-filelink").html("");

    $("#penugasan-id_update").val("");
    $("#penugasan-id_penugasan").val("");
    $("#penugasan-kode_bkn_penugasan").val("");

    $("#penugasan-nama_penugasan").val("");
    $("#penugasan-kode_penugasan").val("").trigger("change");
    $("#penugasan-kedudukan").val("");
    $("#penugasan-tahun").val("");
    // $("#penugasan-bobot_kompetensi").val("");

    $("#penugasan-sk_nomor").val("");
    $("#penugasan-sk_tanggal").val("");

    $(".add-new-data.penugasan").addClass("show");
    $(".overlay-bg.penugasan").addClass("show");

    $("#penugasan-btn-simpan").removeClass("hidden");
    $("#penugasan-btn-batal").removeClass("hidden");

    $("#penugasan-input-alasan").addClass("hidden");
    $("#penugasan-btn-verifikasi").addClass("hidden");
    $("#penugasan-btn-tolak").addClass("hidden");
}
</script>