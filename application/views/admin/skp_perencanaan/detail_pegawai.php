<?php
$iku_list = array();
$j = "sk";
$name = $this->renja_perencanaan_model->name($j);
$sasaran = $this->renja_perencanaan_model->get_sasaran($j, $id_unit_kerja, $tahun);
$sasaran_inisiatif = $this->renja_perencanaan_model->get_sasaran_inisiatif($j, $id_unit_kerja, $tahun);
$sasaran = array_merge($sasaran, $sasaran_inisiatif);
foreach ($sasaran as $s) {
    $tSasaran = $name['tSasaran'];
    $cSasaran = $name['cSasaran'];
    $cSasaranInisiatif = $name['cSasaranInisiatif'];
    if (!empty($s->inisiatif)) {
        $iku = $this->renja_perencanaan_model->get_iku_inisiatif($j, $s->$cSasaranInisiatif, $tahun, $id_unit_kerja);
    } else {
        $iku = $this->renja_perencanaan_model->get_iku($j, $s->$cSasaran, $tahun, $id_unit_kerja);
    }

    $iku_list = array_merge($iku_list, $iku);
}
?>
<div class="container-fluid">

    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Sasaran Kinerja Pegawai</h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

            <ol class="breadcrumb">
                <li><a href="<?= base_url(); ?>/skp_perencanaan">Sasaran Kinerja Pegawai</a></li>
                <li class="active">List</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>

    <div class="row">
        <div class="white-box">
            <div class="user-bg"> <img width="100%" height="100%" alt="user" src="<?= base_url() ?>/data/images/header/header2.jpg">
                <div class="overlay-box">
                    <div class="col-md-3">
                        <div class="user-content" <a="" href="javascript:void(0)"><img src="<?= base_url() ?>/data/foto/pegawai/<?= $pegawai->foto_pegawai ?>" class="thumb-lg img-circle" style=" object-fit: cover;
            width: 80px;
            height: 80px;border-radius: 50%;
            " alt="img">
                            <h5 class="text-white"><b><?= $pegawai->nama_lengkap ?></b></h5>
                            <h6 class="text-white"><?= $pegawai->nip ?></h6>
                        </div>
                    </div>
                    <div class="col-md-3" style="border-right: 1px solid grey;border-left: 1px solid grey;">
                        <br>
                        <div class="user-content" style="padding-bottom:15px;">
                            <h5 class="text-white"><b>SKPD</b></h5>
                            <h6 class="text-white"><?= $pegawai->nama_skpd ?></h6>
                        </div>
                    </div>
                    <div class="col-md-3" style="border-right: 1px solid grey;">
                        <br>
                        <div class="user-content" style="padding-bottom:15px;">
                            <h5 class="text-white"><b>Unit Kerja</b></h5>
                            <h6 class="text-white"><?= $pegawai->nama_unit_kerja ?></h6>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <br>
                        <div class="user-content" style="padding-bottom:15px;">
                            <h5 class="text-white"><b>Jabatan</b></h5>
                            <h6 class="text-white"><?= $pegawai->jabatan ?></h6>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="row">

        <div class="white-box">
            <h3 class="box-title">DAFTAR SASARAN Kinerja</h3>
            <a href="javascript:void(0)" onclick="addSasaran()" class="btn btn-primary"><i class="ti-plus"></i> Tambah Sasaran</a>
            <hr>
            <?php
            if (empty($sasaran_skp)) {
                echo '<div class="alert alert-primary">Belum ada sasaran</div>';
            }
            foreach ($sasaran_skp as $k => $ss) {
                $n = $k + 1;
                $indikator = $this->skp_model->get_indikator($ss->id_sasaran_skp);
                $total_capaian = 0;
                foreach ($indikator as $kk => $ind) {
                    $total_capaian += $ind->capaian;
                }

                if ($total_capaian == 0 || count($indikator) == 0) {
                    $jumlah_indeks = 0;
                } else {
                    $jumlah_indeks = $total_capaian / count($indikator);
                }

            ?>
                <div class="row" style="margin-top: 30px">
                    <p>
                    <div class="btn-group m-r-10">
                        <button aria-expanded="false" data-toggle="dropdown" class="btn btn-primary btn-outline dropdown-toggle waves-effect waves-light" type="button"> <i class="fa fa-gear m-r-5"></i> <span class="caret"></span></button>
                        <ul role="menu" class="dropdown-menu">
                            <li><a href="javascript:void(0)" onclick="editSasaran(<?= $ss->id_sasaran_skp ?>)">Edit</a></li>
                            <li><a href="javascript:void(0)" onclick="hapusSasaran(<?= $ss->id_sasaran_skp ?>)">Hapus</a></li>
                            <li><a href="javascript:void(0)" onclick="addIndikator(<?= $ss->id_sasaran_skp ?>)">Tambah Indikator</a></li>
                        </ul>
                    </div>
                    <span class="badge badge-warning" style="min-width:50px"><?= $jumlah_indeks ?></span>&nbsp;&nbsp;
                    <strong>Sasaran <?= $n ?>.</strong> <?= $ss->nama_sasaran ?> </p>
                    <div class="table-responsive dragscroll">
                        <table class="table color-table muted-table">
                            <thead>
                                <tr>
                                    <th style="vertical-align: middle;text-align: center;width:71px">Indeks Capaian Iku</th>
                                    <th style="vertical-align: middle;text-align: center;width:50px">Kode</th>
                                    <th style="vertical-align: middle;text-align: center;">Indikator</th>
                                    <th style="vertical-align: middle;text-align: center;width:68px">Satuan</th>
                                    <th style="vertical-align: middle;text-align: center;width:76px">Target</th>
                                    <th style="vertical-align: middle;text-align: center;width:76px">Realisasi</th>
                                    <th style="vertical-align: middle;text-align: center;width:100px">Anggaran</th>
                                    <th style="vertical-align: middle;text-align: center;width:82px">Polarisasi</th>
                                    <th style="vertical-align: middle;text-align: center;width:200px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (empty($indikator)) {
                                ?>
                                    <tr>
                                        <td colspan="9">
                                            <center>Belum ada indikator</center>
                                        </td>
                                    </tr>
                                <?php
                                }
                                foreach ($indikator as $kk => $ind) {
                                    $nn = $kk + 1;

                                ?>
                                    <tr>
                                        <td><span class="badge badge-warning" style="min-width:50px"><?= $ind->capaian ?></span></td>
                                        <td class="text-center"><?= "$n.$nn" ?></td>
                                        <td><?= $ind->nama_indikator ?></td>
                                        <td class="text-center"><?= $ind->satuan ?></td>
                                        <td class="text-center"><?= $ind->target ?></td>
                                        <td class="text-center"><?= $ind->realisasi ?></td>
                                        <td class="text-center"><?= rupiah($ind->anggaran) ?></td>
                                        <td class="text-center"><?= $ind->polarisasi ?></td>
                                        <td>
                                            <a href="javascript:void(0)" onclick="editIndikator(<?= $ind->id_sasaran_skp_indikator ?>)" class="btn btn-info">Edit</a>
                                            <a href="javascript:void(0)" onclick="hapusIndikator(<?= $ind->id_sasaran_skp_indikator ?>)" class="btn btn-danger">Hapus</a>
                                            <a href="javascript:void(0)" onclick="updateRealisasi(<?= $ind->id_sasaran_skp_indikator ?>)" class="btn btn-primary">Update Realisasi</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            <?php } ?>


        </div>
        <div class="modal fade" id="modalSasaran" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="titleSasaran">Tambah Sasaran</h4>
                    </div>
                    <div class="modal-body">
                        <form id="formSasaran">

                            <input type="hidden" name="id_sasaran_skp">
                            <input type="hidden" name="tahun" value="<?= $tahun ?>">
                            <div class="form-group">
                                <label class="control-label">Indikator Kegiatan</label>
                                <select class="form-control select2" name="id_iku_sk_renja">
                                    <option value="">Pilih Kegiatan</option>
                                    <?php
                                    foreach ($iku_list as $l) {
                                        echo '<option value="' . $l->id_iku_sk_renja . '">' . $l->iku_sk_renstra . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Nama Sasaran</label>
                                <input type="text" name="nama_sasaran" class="form-control" placeholder="Masukkan Nama Sasaran">
                            </div>


                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        <button type="button" id="btnSasaran" onclick="saveSasaran('add')" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="modalIndikator" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="titleIndikator">Tambah Indikator Sasaran</h4>
                    </div>
                    <div class="modal-body">
                        <form id="formIndikator">
                            <input type="hidden" name="id_sasaran_skp_indikator">
                            <div class="form-group">
                                <label class="control-label">Sasaran</label>
                                <select class="form-control select2" name="id_sasaran_skp">
                                    <option value="">Pilih Sasaran</option>
                                    <?php
                                    foreach ($sasaran_skp as $s) {
                                        echo '<option value="' . $s->id_sasaran_skp . '">' . $s->nama_sasaran . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Nama Indikator</label>
                                <input type="text" class="form-control" name="nama_indikator" placeholder="Masukkan Nama Indikator">
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Target</label>
                                <input type="text" class="form-control" name="target" placeholder="Masukkan Target Indikator">
                            </div>

                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Satuan</label>
                                <select class="form-control select2" name="id_satuan">
                                    <option value="">Pilih Satuan</option>
                                    <?php
                                    foreach ($satuan as $sat) {
                                        echo '<option value="' . $sat->id_satuan . '">' . $sat->satuan . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Polarisasi</label>
                                <div class="radio-list">
                                    <label class="radio-inline p-0">
                                        <div class="radio radio-primary">
                                            <input type="radio" id="radio1" name="polarisasi" value="Maximize">
                                            <label for="radio1">Maximize</label>
                                        </div>
                                    </label>
                                    <label class="radio-inline">
                                        <div class="radio radio-primary">
                                            <input type="radio" id="radio2" name="polarisasi" value="Minimize">
                                            <label for="radio2">Minimize</label>
                                        </div>
                                    </label>

                                    <label class="radio-inline">
                                        <div class="radio radio-primary">
                                            <input type="radio" id="radio3" name="polarisasi" value="Stabilize">
                                            <label for="radio3">Stabilize</label>
                                        </div>
                                    </label>
                                </div>
                            </div>



                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" id="btnIndikator" onclick="saveIndikator('add')" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="modalRealisasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel1">Update Realisasi</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" id="formRealisasi">
                            <input type="hidden" name="id_sasaran_skp_indikator">
                            <div class="form-group">
                                <label class="col-sm-12">Realisasi</label>
                                <div class="col-md-12">
                                    <input type="text" name="realisasi" id="realisasi_renja" class="form-control" placeholder="Masukkan Realisasi Indikator">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input type="checkbox" id="rPerhitungan" name="perhitungan_capaian" value="manual" class="js-switch" onchange="toggleCapaian()" data-color="#6003c8" data-size="small" /> Hitung Capaian Manual
                                    <small style="display: block;margin-top:5px">Aktifkan Capaian Manual apabila realisasi <b>bukan</b> angka. (misal. A, Baik, dll)</small>
                                </div>
                            </div>
                            <div class="form-group" id="formCapaian" style="display: none;">
                                <label class="col-sm-12">Capaian</label>
                                <div class="col-md-12">
                                    <input type="text" id="txtCapaian" class="form-control" name="capaian">
                                </div>
                            </div>


                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="saveRealisasi()">Simpan</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function addSasaran() {
                clearForm("formSasaran");
                $('#titleSasaran').html('Tambah Sasaran');
                $('#btnSasaran').attr('onclick', "saveSasaran('add')");
                $('#modalSasaran').modal('show');
            }

            function editSasaran(id_sasaran_skp) {

                clearForm("formSasaran");
                $('#titleSasaran').html('Edit Sasaran');
                $.getJSON("<?= base_url('skp_perencanaan/getSasaranByID') ?>/" + id_sasaran_skp, function(data) {
                    $('#btnSasaran').attr('onclick', "saveSasaran('edit')");
                    $('#formSasaran [name="id_sasaran_skp"]').val(data.id_sasaran_skp);
                    $('#formSasaran [name="id_iku_sk_renja"]').val(data.id_iku_sk_renja);
                    $('#formSasaran [name="id_iku_sk_renja"]').trigger('change');
                    $('#formSasaran [name="nama_sasaran"]').val(data.nama_sasaran);
                    $('#modalSasaran').modal('show');
                });
            }

            function addIndikator(id_sasaran_skp) {
                clearForm("formIndikator");
                $('#titleIndikator').html('Tambah Indikator');
                $('#btnIndikator').attr('onclick', "saveIndikator('add')");
                $('#formIndikator [name="id_sasaran_skp"]').val(id_sasaran_skp);
                $('#formIndikator [name="id_sasaran_skp"]').trigger('change');
                $('#modalIndikator').modal('show');
            }

            function editIndikator(id_sasaran_skp_indikator) {
                clearForm("formIndikator");
                $('#titleIndikator').html('Edit Indikator');
                $.getJSON("<?= base_url('skp_perencanaan/getIndikatorByID') ?>/" + id_sasaran_skp_indikator, function(data) {
                    $('#btnIndikator').attr('onclick', "saveIndikator('edit')");
                    $('#formIndikator [name="id_sasaran_skp_indikator"]').val(data.id_sasaran_skp_indikator);
                    $('#formIndikator [name="id_sasaran_skp"]').val(data.id_sasaran_skp);
                    $('#formIndikator [name="id_sasaran_skp"]').trigger('change');
                    $('#formIndikator [name="nama_indikator"]').val(data.nama_indikator);
                    $('#formIndikator [name="target"]').val(data.target);
                    $('#formIndikator [name="id_satuan"]').val(data.id_satuan);
                    $('#formIndikator [name="id_satuan"]').trigger('change');
                    $('#formIndikator [name="polarisasi"][value="' + data.polarisasi + '"]').prop('checked', true);
                    $('#modalIndikator').modal('show');
                });
            }

            function updateRealisasi(id_sasaran_skp_indikator) {
                clearForm("formRealisasi");
                $.getJSON("<?= base_url('skp_perencanaan/getIndikatorbyID') ?>/" + id_sasaran_skp_indikator, function(data) {

                    $('#formRealisasi [name="id_sasaran_skp_indikator"]').val(id_sasaran_skp_indikator);
                    $('#formRealisasi [name="realisasi"]').val(data.realisasi);
                    if (data.perhitungan_capaian == "manual") {
                        $('#formCapaian').show();
                        $('#formRealisasi [name="perhitungan_capaian"]').prop('checked', true);
                        $('#formRealisasi [name="capaian"]').val(data.capaian);
                    } else {
                        $('#formCapaian').hide();
                        $('#formRealisasi [name="perhitungan_capaian"]').prop('checked', false);

                    }
                    $('#modalRealisasi').modal('show');

                });
            }

            function toggleCapaian() {
                $('#formCapaian').toggle();
            }

            function saveSasaran(method) {
                $.post("<?= base_url('skp_perencanaan/saveSasaran') ?>/" + method, $("#formSasaran").serialize(), function(data) {
                    swal(data.title, data.message, data.message_type);
                    if (data.message_type == "success") {
                        window.location.reload(false);
                    }
                }, "json");
            }

            function saveIndikator(method) {
                $.post("<?= base_url('skp_perencanaan/saveIndikator') ?>/" + method, $("#formIndikator").serialize(), function(data) {
                    swal(data.title, data.message, data.message_type);
                    if (data.message_type == "success") {
                        window.location.reload(false);
                    }
                }, "json");
            }


            function saveRealisasi() {
                var id_sasaran_skp_indikator = $('#formRealisasi [name="id_sasaran_skp_indikator"]').val();
                var realisasi = $('#formRealisasi [name="realisasi"]').val();
                $.post("<?= base_url('skp_perencanaan/saveRealisasi') ?>", $("#formRealisasi").serialize(), function(data) {
                    swal(data.title, data.message, data.message_type);
                    if (data.message_type == "success") {
                        window.location.reload(false);
                    }
                }, "json");
            }

            function hapusSasaran(id_sasaran_skp) {
                swal({
                    title: "Apakah anda yakin?",
                    text: "Data yang sudah dihapus tidak dapat dikembalikan",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it!",
                    closeOnConfirm: false
                }, function(isConfirm) {
                    if (!isConfirm) return;
                    $.ajax({
                        url: "<?= base_url('skp_perencanaan/deleteSasaran') ?>/" + id_sasaran_skp,
                        type: "GET",
                        dataType :"JSON",
                        success: function(data) {
                            swal(data.title, data.message, data.message_type);
                            if (data.message_type == "success") {
                                window.location.reload(false);
                            }
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            swal("Error deleting!", "Please try again", "error");
                        }
                    });
                });
            }

            
            function hapusIndikator(id_sasaran_skp_indikator) {
                swal({
                    title: "Apakah anda yakin?",
                    text: "Data yang sudah dihapus tidak dapat dikembalikan",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it!",
                    closeOnConfirm: false
                }, function(isConfirm) {
                    if (!isConfirm) return;
                    $.ajax({
                        url: "<?= base_url('skp_perencanaan/deleteIndikator') ?>/" + id_sasaran_skp_indikator,
                        type: "GET",
                        dataType :"JSON",
                        success: function(data) {
                            swal(data.title, data.message, data.message_type);
                            if (data.message_type == "success") {
                                window.location.reload(false);
                            }
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            swal("Error deleting!", "Please try again", "error");
                        }
                    });
                });
            }

            function clearForm(formName) {
                $('#' + formName).find('input:text').val('');
                $('#' + formName).find('input:radio').prop('checked', false);
                $('#' + formName).find('textarea').text('');
                $('#' + formName).find('textarea').val('');
                $('#' + formName).find('select').val('');
                $('#' + formName).find('select').trigger('change');
            }
        </script>