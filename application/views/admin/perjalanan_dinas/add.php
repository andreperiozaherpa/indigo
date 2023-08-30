<div class="container-fluid">

    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Perjalanan Dinas</h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

            <ol class="breadcrumb">
                <li><a href="https://e-office.sumedangkab.go.id/admin">Dashboard</a></li>
                <li><a href="https://e-office.sumedangkab.go.id/kegiatan_personal">Perjalanan Dinas</a></li>
                <li class="active">Pengajuan</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <h3 class="box-title">TAMBAH PERJALANAN DINAS</h3>
                <?php
                if (isset($message)) {
                ?>
                    <div class="alert alert-<?= $message_type ?>"><?= $message ?></div>
                <?php
                }
                ?>
                <form method="POST">
                    <div class="form-group">
                        <label>Bagian</label>
                        <select name="id_unit_kerja" class="form-control select2">
                            <option value="">Pilih Bagian</option>
                            <?php
                            foreach ($bagian as $b) {
                                echo "<option value=\"$b->id_unit_kerja\">" . ($b->nama_unit_kerja) . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi Kegiatan</label>
                        <textarea class="form-control" name="deskripsi_kegiatan" placeholder="Masukkan Deskripsi Kegiatan"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Jenis Perjalanan</label>
                        <select onchange="toggleSubJenis()" name="jenis_perjalanan" class="form-control">
                            <option value="">Pilih Jenis Perjalanan</option>
                            <?php
                            $ljenisperjalanan = array('biasa', 'luar_negeri');
                            foreach ($ljenisperjalanan as $lj) {
                                echo "<option value=\"$lj\">" . normal_string($lj) . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group" id="divSubJenis" style="display: none;">
                        <label>Sub Jenis Perjalanan</label>
                        <select name="sub_jenis_perjalanan" class="form-control">
                            <option value="">Pilih Sub Jenis Perjalanan</option>
                            <?php
                            $lsub_jenis_perjalanan = array('dalam_daerah', 'luar_daerah');
                            foreach ($lsub_jenis_perjalanan as $lj) {
                                echo "<option value=\"$lj\">" . normal_string($lj) . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tujuan</label>
                        <input type="text" class="form-control" name="tujuan" placeholder="Masukkan Tempat Tujuan" />
                    </div>
                    <div class="form-group">
                        <label>Waktu</label>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="radio radio-primary" style="display: inline-block;margin-right:15px">
                                    <input type="radio" name="jenis_waktu" onclick="toggleWaktu()" id="single" value="single" checked>
                                    <label for="single"> 1 Hari </label>
                                </div>
                                <div class="radio radio-primary" style="display: inline-block;margin-right:10px">
                                    <input type="radio" name="jenis_waktu" onclick="toggleWaktu()" id="multi" value="multi">
                                    <label for="multi"> Lebih dari 1 Hari </label>
                                </div>
                            </div>
                        </div>
                        <div class="input-group" id="divSingle">
                            <span class="input-group-addon"><i class="ti-calendar"></i></span>
                            <input type="text" autocomplete="off" name="tanggal_pelaksanaan" placeholder="Pilih Tanggal Pelaksanaan Kegiatan" class="form-control mydatepicker">
                        </div>
                        <div class="input-group" id="divMulti" style="display: none;">
                            <span class="input-group-addon"><i class="ti-calendar"></i></span>
                            <input type="text" autocomplete="off" name="tanggal_awal" placeholder="Pilih Tanggal Awal Pelaksanaan Kegiatan" class="form-control mydatepicker">
                            <span class="input-group-addon" style="background:#6003c8;color:white">s.d</span>
                            <input type="text" autocomplete="off" name="tanggal_akhir" placeholder="Pilih Tanggal Akhir Pelaksanaan Kegiatan" class="form-control mydatepicker">
                        </div>
                    </div>

                    <h3 class="box-title">PEMBIAYAAN DAN DAFTAR PEGAWAI</h3>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Biaya Transport</label>
                                <input type="text" name="biaya_transport" class="form-control" placeholder="Masukkan Biaya Transport" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Jenis Transportasi</label>
                                <select name="jenis_transportasi" class="form-control select2" required>
                                    <option value="">Pilih Jenis Transportasi</option>
                                    <?php
                                    $ljenisperjalanan = array('mobil', 'pesawat_terbang', 'bus', 'kereta', 'sepeda_motor', 'taksi', 'kapal_feri');
                                    foreach ($ljenisperjalanan as $lj) {
                                        echo "<option value=\"$lj\">" . normal_string($lj) . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Uang Refresentasi</label>
                                <input type="text" name="uang_refresentasi" class="form-control" placeholder="Masukkan Uang Refresentasi" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Nomor Rekening</label>
                                <input type="text" name="nomor_rekening" class="form-control" placeholder="Masukkan Nomor Rekening" required>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered color-table primary-table" id="tablePegawai">
                        <thead>
                            <tr>
                                <th rowspan="2" style="vertical-align: middle;text-align:center;width:25%">Nama Pegawai</th>
                                <th rowspan="2" style="vertical-align: middle;text-align:center;">Surat Perintah</th>
                                <th colspan="2" style="vertical-align: middle;text-align:center">Uang Harian</th>
                                <th colspan="2" style="vertical-align: middle;text-align:center">Biaya Penginapan</th>
                                <th rowspan="2" style="vertical-align: middle;text-align:center;"></th>
                            </tr>
                            <tr>
                                <th style="vertical-align: middle;text-align:center;width:7.5%">Vol</th>
                                <th style="vertical-align: middle;text-align:center">Rp</th>
                                <th style="vertical-align: middle;text-align:center;width:7.5%">Vol</th>
                                <th style="vertical-align: middle;text-align:center">Rp</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="vertical-align: middle">
                                    <div id="divPegawaiOption">
                                        <div id="checkboxJenis" class="checkbox checkbox-primary" style="display: inline-block;margin-top:0px">
                                            <input id="jenis_pegawai" type="checkbox" class="jenisPegawai" value="Y">
                                            <label for="jenis_pegawai"> Non PNS </label>
                                            <input type="hidden" name="jenis_pegawai[]" value="N">
                                        </div>
                                        <div id="checkboxKoor" class="checkbox checkbox-primary" style="display: inline-block;margin-left:15px;margin-top:0px">
                                            <input id="koordinator" type="checkbox" class="koordinator" value="Y">
                                            <label for="koordinator"> Koordinator </label>
                                            <input type="hidden" name="koordinator[]" value="N">
                                        </div>
                                    </div>
                                    <div id="divPegawaiName">
                                        <input type="text" id="pegawai" class="form-control pegawaiSelect" placeholder="Pilih Pegawai" name="id_pegawai[]" required>
                                        <input type="hidden" name="nama_jabatan[]" value="N"><input type="hidden" name="id_pegawai_atasan[]" value="N">
                                    </div>
                                </td>
                                <td style="vertical-align: middle">
                                    <input type="text" class="form-control" name="no_sp[]" placeholder="Nomor SP">
                                    <input style="margin-top: 10px;" type="date" class="form-control" autocomplete="off" name="tanggal_sp[]" placeholder="Tanggal">
                                </td>
                                <td style="vertical-align: middle">
                                    <input type="text" class="form-control" name="volume_uh[]" placeholder="Masukkan Vol">
                                </td>
                                <td style="vertical-align: middle">
                                    <div class="input-group">
                                        <span class="input-group-addon">Rp.</span>
                                        <input type="text" class="form-control" name="nominal_uh[]" placeholder="Masukkan Nominal">
                                    </div>
                                </td>
                                <td style="vertical-align: middle">
                                    <input type="text" class="form-control" name="volume_bp[]" placeholder="Masukkan Vol">
                                </td>
                                <td style="vertical-align: middle">
                                    <div class="input-group">
                                        <span class="input-group-addon">Rp.</span>
                                        <input type="text" class="form-control" name="nominal_bp[]" placeholder="Masukkan Nominal">
                                    </div>
                                </td>
                                <td style="vertical-align: middle">
                                    <button type="button" class="btn btn-danger btn-circle deletePegawai"><i class="ti-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="button" id="addPegawai" class="btn btn-primary pull-right"><i class="ti-plus"></i> Tambah Pegawai</button>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <button class="btn btn-primary" class="submit"><i class="ti-save"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function toggleWaktu() {
        var jenis_waktu = $('input[name="jenis_waktu"]:checked').val();
        if (jenis_waktu == 'multi') {
            $('#divMulti').show();
            $('#divSingle').hide();
        } else {
            $('#divMulti').hide();
            $('#divSingle').show();
        }
    }

    function toggleSubJenis() {
        var jenis = $('[name="jenis_perjalanan"]').val();
        if (jenis == 'biasa') {
            $('[name="sub_jenis_perjalanan"]').removeAttr('disabled');
            $('#divSubJenis').show();
        } else {
            $('[name="sub_jenis_perjalanan"]').attr('disabled', 'disabled');
            $('#divSubJenis').hide();
        }
    }
</script>

<script>
    $(document).ready(function() {

        $('#divTerhitung').hide();
        $('#divPeriode').hide();

        $('.pegawaiSelect').select2({
            minimumInputLength: 2,
            allowClear: true,
            placeholder: 'Pilih Pegawai',
            ajax: {
                dataType: 'json',
                url: '<?= base_url('perjalanan_dinas/get_pegawai') ?>',
                data: function(term, page) {
                    return {
                        search: term, //search term
                    };
                },
                results: function(data, page) {
                    return {
                        results: data
                    };
                },
            }
        });

    });
</script>


<script>
    $('#addPegawai').click(function() {
        $("#tablePegawai tbody tr:last").find('.pegawaiSelect').select2('destroy');
        var append = $("#tablePegawai tbody tr:last").clone();
        var jumlah = $("#tablePegawai tbody tr").length;
        append.find('input:text').val('');
        append.find('input:checkbox').prop('checked', false);
        append.find('input:radio').prop('checked', false);
        append.find('textarea').text('');
        append.find('textarea').val('');
        append.find('#checkboxKoor input').attr('id', 'koor' + jumlah);
        append.find('#checkboxKoor label').attr('for', 'koor' + jumlah);
        append.find('#checkboxJenis input').attr('id', 'jenis' + jumlah);
        append.find('#checkboxJenis label').attr('for', 'jenis' + jumlah);
        append.find('select').val('');
        append.find('select').trigger('change');
        $("#tablePegawai tbody").append(append);
        $('.pegawaiSelect').select2({
            minimumInputLength: 2,
            allowClear: true,
            placeholder: 'Pilih Pegawai',
            ajax: {
                dataType: 'json',
                url: '<?= base_url('perjalanan_dinas/get_pegawai') ?>',
                data: function(term, page) {
                    return {
                        search: term, //search term
                    };
                },
                results: function(data, page) {
                    return {
                        results: data
                    };
                },
            }
        });

    })
    $("#tablePegawai").on('click', '.deletePegawai', function() {
        var table = document.getElementById('tablePegawai');
        var rowCount = table.rows.length;
        // alert(rowCount);
        if (rowCount > 2) {
            $(this).parent().parent().remove();
        }
    });
    $(document).on('click', '.jenisPegawai', function() {
        var jenisPegawai = $(this).is(":checked");
        var divPegawai = $(this).closest('#divPegawaiOption').next();
        var inputJenis = $(this).closest('#checkboxJenis').find('[name="jenis_pegawai[]"]');
        if (jenisPegawai == true) {
            var rand = Math.floor(Math.random() * 1001);
            divPegawai.html('<input type="text" class="form-control" placeholder="Masukkan Nama Pegawai" name="id_pegawai[]" required><input type="text" class="form-control m-t-10" placeholder="Masukkan Jabatan" name="nama_jabatan[]" required><input type="text" class="form-control m-t-10" id="atasan_' + rand + '" placeholder="Masukkan Nama Atasan" name="id_pegawai_atasan[]" required>');
            inputJenis.val('Y');
            $('#atasan_' + rand).select2({
                minimumInputLength: 2,
                allowClear: true,
                placeholder: 'Pilih Pegawai',
                ajax: {
                    dataType: 'json',
                    url: '<?= base_url('perjalanan_dinas/get_pegawai') ?>',
                    data: function(term, page) {
                        return {
                            search: term, //search term
                        };
                    },
                    results: function(data, page) {
                        return {
                            results: data
                        };
                    },
                }
            });
        } else {
            inputJenis.val('N');
            var rand = Math.floor(Math.random() * 1001);
            divPegawai.html('<input type="text" id="pegawai_' + rand + '" class="form-control pegawaiSelect" placeholder="Pilih Pegawai" name="id_pegawai[]" required><input type="hidden" name="nama_jabatan[]" value="N"><input type="hidden" name="id_pegawai_atasan[]" value="N">');
            $('#pegawai_' + rand).select2({
                minimumInputLength: 2,
                allowClear: true,
                placeholder: 'Pilih Pegawai',
                ajax: {
                    dataType: 'json',
                    url: '<?= base_url('perjalanan_dinas/get_pegawai') ?>',
                    data: function(term, page) {
                        return {
                            search: term, //search term
                        };
                    },
                    results: function(data, page) {
                        return {
                            results: data
                        };
                    },
                }
            });
        }
    });
    $(document).on('click', '.koordinator', function() {
        var koordinator = $(this).is(":checked");
        var inputKoor = $(this).closest('#checkboxKoor').find('[name="koordinator[]"]');
        if (koordinator == true) {
            inputKoor.val('Y');
        } else {
            inputKoor.val('N');
        }
    });
    $(document).on('change', '[name="id_pegawai[]"]', function(e) {
        var jenis_waktu = $('[name="jenis_waktu"]:checked').val();
        var id_pegawai = $(this).val();
        var tanggal_pelaksanaan = $('[name="tanggal_pelaksanaan"]').val();
        var tanggal_awal = $('[name="tanggal_awal"]').val();
        var tanggal_akhir = $('[name="tanggal_akhir"]').val();
        var po = $(this);
        $.post("<?= base_url('perjalanan_dinas/cek_name') ?>", {
            jenis_waktu: jenis_waktu,
            id_pegawai: id_pegawai,
            tanggal_awal: tanggal_awal,
            tanggal_akhir: tanggal_akhir,
            tanggal_pelaksanaan: tanggal_pelaksanaan
        }, function(data) {
            if (data.result == false) {
                swal('Peringatan', data.message, "warning");
                if (data.jenis_pegawai == 'pns') {
                    po.select2('destroy');
                    po.select2({
                        minimumInputLength: 2,
                        allowClear: true,
                        placeholder: 'Pilih Pegawai',
                        ajax: {
                            dataType: 'json',
                            url: '<?= base_url('perjalanan_dinas/get_pegawai') ?>',
                            data: function(term, page) {
                                return {
                                    search: term, //search term
                                };
                            },
                            results: function(data, page) {
                                return {
                                    results: data
                                };
                            },
                        }
                    });
                }else{
                    po.val('');
                }
            }
        }, "json");
    });
</script>