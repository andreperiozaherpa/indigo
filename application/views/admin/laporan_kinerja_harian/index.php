<style>
    .checked {
        color: #6003c8;
    }
</style>
<div class="container-fluid">

    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Input LKH</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li>Laporan Kinerja Harian</li>
                <li class="active">Input</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <div class="row">
                    <div class="col-md-3 mb-small">
                        <br>
                        <a href="#" class="btn btn-primary btn-block" onclick="addLaporan()">Tambah Laporan Kinerja Harian</a>
                    </div>
                    <form method="POST">
                        <div class="col-md-5">
                            <label for="">Tanggal Laporan</label>
                            <div class="input-group">
                                <input type="text" class="form-control" value="<?= $tanggal_awal ?>" name="tanggal_awal" autocomplete="off" id="datepicker" placeholder="Tanggal Awal">
                                <div class="input-group-addon">s.d.</div>
                                <input type="text" class="form-control" value="<?= $tanggal_akhir ?>" name="tanggal_akhir" autocomplete="off" id="datepicker" placeholder="Tanggal Akhir">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="">Status</label>
                            <select class="form-control" name="status_verifikasi">
                                <option value="">Semua Status</option>
                                <?php
                                $status = array('belum_diverifikasi', 'sudah_diverifikasi', 'ditolak');
                                foreach ($status as $s) {
                                    $selected = set_value('status_verifikasi') == $s ? ' selected' : '';
                                    echo '<option value="' . $s . '"' . $selected . '>' . normal_string($s) . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group text-center">
                                <br>
                                <button type="submit" class="btn btn-primary btn-outline m-t-5" name="type" value="filter"><i class="ti-search"></i> Filter Kegiatan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="white-box">
                <div class="row">
                    <div class="col-md-12">
                        <a href="javascript:void(0)" onclick="showDownload()" class="btn btn-primary mb-4 pull-right"><i class="ti-file"></i> Download Rekap LKH</a>
                    </div>
                </div>
                <?php
                if (isset($message)) {
                ?>
                    <div class="alert alert-<?= $message_type ?>"><?= $message ?></div>
                <?php } ?>
                <hr>
                <div class="table-responsive">
                    <table class="table color-table primary-table" id="tablelKH">
                        <thead>
                            <tr>
                                <th class="text-center" width="3%">No.</th>
                                <th>Hari / Tanggal</th>
                                <th width="32%">Rincian Kegiatan</th>
                                <th width="32%">Hasil</th>
                                <th class="text-center" width="10%">Komentar</th>
                                <th class="text-center" width="13%">Status</th>
                                <th class="text-center" width="100px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="7"><center>Data tidak ditemukan</center></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalLaporan" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myLargeModalLabel">Form Laporan Kinerja Harian</h4>
            </div>
            <div class="modal-body">
                <?= form_open_multipart() ?>
                <input type="hidden" name="id_laporan_kerja_harian">
                <div class="form-group">
                    <label>Tanggal</label>
                    <input type="text" class="form-control " name="tanggal" id="datepicker" autocomplete="off" placeholder="Pilih Tanggal Pekerjaan" required>
                </div>
                <div class="form-group">
                    <label>Rincian Kegiatan</label>
                    <textarea class="form-control textarea_editor" rows="10" name="rincian_kegiatan" placeholder="Masukkan Rincian Kegiatan" required></textarea>
                </div>
                <div class="form-group">
                    <label>Hasil</label>
                    <textarea class="form-control textarea_editor" rows="10" name="hasil_kegiatan" placeholder="Masukkan Hasil" required></textarea>
                </div>
                <div class="form-group">
                    <label>Lampiran / Evidence <small>(Opsional)</small></label>
                    <input type="file" class="dropify" name="lampiran">
                </div>
                <div class="form-group">
                    <label>Verifikator</label>
                    <select class="form-control select2" name="id_verifikator">
                        <option value="">Pilih Verifikator</option>
                        <?php
                        foreach ($pegawai as $p) {
                            echo '<option value="' . $p->id_pegawai . '">' . $p->nama_lengkap . ' - ' . $p->jabatan . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <a href="javascript:void(0)" data-dismiss="modal" class="btn btn-default waves-effect text-left">Tutup</a>
                <button type="submit" name="type" class="btn btn-primary waves-effect text-left">Simpan</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="modalDetailPenolakan" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myLargeModalLabel">Detail Penolakan</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="text-danger">Alasan Penolakan</label>
                    <p id="alasan_penolakan"></p>
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

<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myLargeModalLabel">Konfirmasi</h4>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin akan menghapus Laporan ini?<br>
                    <small>Data yang sudah terhapus tidak bisa dikembalikan lagi</small>

                </p>
            </div>
            <div class="modal-footer">
                <a href="javascript:void(0)" data-dismiss="modal" class="btn btn-default waves-effect text-left">Tidak</a>
                <a href="" id="btnHapus" class="btn btn-primary waves-effect text-left">Ya</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<div class="modal fade" id="modalDownload" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myLargeModalLabel">Download Rekap Catatan Kerja Pegawai</h4>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= base_url('laporan_kinerja_harian/download_rekap_lkh') ?>" target="_blank">
                    <input type="hidden" name="id_pegawai" value="<?= $this->session->userdata('id_pegawai') ?>">
                    <div class="form-group">
                        <label>Bulan</label>
                        <select name="bulan" class="form-control" required>
                            <option value="">Pilih Bulan</option>
                            <?php
                            for ($i = 1; $i <= 12; $i++) {
                                $selected = set_value('bulan') == $i ? ' selected' : '';
                                echo '<option value="' . $i . '"' . $selected . '>' . bulan($i) . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tahun</label>
                        <label>Tahun</label>
                        <select name="tahun" class="form-control" required>
                            <option value="">Pilih Tahun</option>
                            <?php
                            for ($i = 2020; $i <= 2025; $i++) {
                                $selected = set_value('tahun') == $i ? ' selected' : '';
                                echo '<option value="' . $i . '"' . $selected . '>' . $i . '</option>';
                            }
                            ?>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <a href="javascript:void(0)" data-dismiss="modal" class="btn btn-default waves-effect text-left">Tutup</a>
                <button type="submit" class="btn btn-primary"><i class="ti-download"></i> Download</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modalDetailLaporan" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myLargeModalLabel">Detail Laporan Kinerja Harian</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama Pegawai</label>
                    <p id="nama_pegawai" class="text-purple"></p>
                </div>
                <div class="form-group">
                    <label>Tanggal</label>
                    <p id="tanggal"></p>
                </div>
                <div class="form-group">
                    <label>Rincian Kegiatan</label>
                    <p id="rincian_kegiatan"></p>
                </div>
                <div class="form-group">
                    <label>Hasil</label>
                    <p id="hasil_kegiatan"></p>
                </div>
                <div class="form-group" id="forLampiran" style="display: none">
                    <a href="" id="btnLampiran" target="_blank" class="btn btn-primary"><i class="ti-download"></i> Download Lampiran</a>
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

<script>
    $(document).ready(function() {

        $('#tablelKH').DataTable({
            "pageLength": 10,
            "serverSide": true,
            "processing" : true,
            "ordering" : false,
            "ajax": {
                url: base_url + 'laporan_kinerja_harian/listLKH',
                type: 'POST'
            },
            "language" : {
                "processing" : '<i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></i> Memuat Data LKH ...'
            }
        }); // End of DataTable

    }); 
    function detailLaporan(idLaporan) {
        $('[name="id_laporan_kerja_harian"]').val(idLaporan);
        $.getJSON("<?= base_url('laporan_kinerja_harian/get_detail_json') ?>/" + idLaporan, function(data) {
            $('#nama_pegawai').html(data.nama_pegawai);
            $('#tanggal').html(data.tanggal_text);
            $('#rincian_kegiatan').html(data.rincian_kegiatan);
            $('#hasil_kegiatan').html(data.hasil_kegiatan);
            if (data.lampiran == '' || data.lampiran == 'null') {
                $('#forLampiran').hide();
            } else {
                $('#forLampiran').show();
                $('#btnLampiran').attr('href', "<?= base_url('data/kegiatan_personal') ?>/" + data.id_pegawai + "/" + data.lampiran);
            }
            $('#modalDetailLaporan').modal('show');
        });
    }

    function addLaporan() {
        $('[name="tanggal"]').val('');
        $('[name="rincian_kegiatan"]').data('wysihtml5').editor.setValue('');
        $('[name="hasil_kegiatan"]').data('wysihtml5').editor.setValue('');
        $('[name="id_verifikator"]').val('');
        $('[name="id_laporan_kerja_harian"]').val('');
        var imagenUrl = "";
        var drEvent = $('[name="lampiran"]').dropify({
            defaultFile: imagenUrl
        });
        drEvent = drEvent.data('dropify');
        drEvent.resetPreview();
        drEvent.clearElement();
        drEvent.settings.defaultFile = imagenUrl;
        drEvent.destroy();
        drEvent.init();
        $('[name="type"]').val('add');
        $('#modalLaporan').modal('show');
    }

    function editLaporan(idLaporan) {
        $('[name="id_laporan_kerja_harian"]').val(idLaporan);
        $.getJSON("<?= base_url('laporan_kinerja_harian/get_detail_json') ?>/" + idLaporan, function(data) {
            $('[name="tanggal"]').val(data.tanggal);
            $('[name="rincian_kegiatan"]').data('wysihtml5').editor.setValue(data.rincian_kegiatan);
            $('[name="hasil_kegiatan"]').data('wysihtml5').editor.setValue(data.hasil_kegiatan);
            $('[name="id_verifikator"]').val(data.id_verifikator).trigger('change');
            if (data.lampiran == '') {
                var imagenUrl = "";
            } else {
                var imagenUrl = "<?= base_url('data/kegiatan_personal') ?>/" + data.id_pegawai + "/" + data.lampiran;
            }
            var drEvent = $('[name="lampiran"]').dropify({
                defaultFile: imagenUrl
            });
            drEvent = drEvent.data('dropify');
            drEvent.resetPreview();
            drEvent.clearElement();
            drEvent.settings.defaultFile = imagenUrl;
            drEvent.destroy();
            drEvent.init();
            $('[name="type"]').val('edit');
            $('#modalLaporan').modal('show');
        });
    }

    function detailPenolakan(idLaporan) {
        $.getJSON("<?= base_url('laporan_kinerja_harian/get_detail_json') ?>/" + idLaporan, function(data) {
            $('#alasan_penolakan').html(data.alasan_penolakan);
            $('#modalDetailPenolakan').modal('show');
        });
    }

    function deleteLaporan(idLaporan) {
        $('#btnHapus').attr('href', '<?= base_url('laporan_kinerja_harian/delete') ?>/' + idLaporan);
        $('#modalDelete').modal('show');
    }

    function showDownload() {
        $('#modalDownload').modal('show');
    }
</script>