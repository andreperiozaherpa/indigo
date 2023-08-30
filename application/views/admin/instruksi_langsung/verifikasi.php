<div class="container-fluid">

    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Verifikasi LKH</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li>Laporan Kinerja Harian</li>
                <li class="active">Verifikasi</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <div class="row">
                    <form method="POST">
                        <div class="col-md-3">
                            <label>Pegawai</label>

                            <input type="text" class="form-control" value="<?=set_value('nama_pegawai')?>" name="nama_pegawai" placeholder="Nama Pegawai">
                        </div>
                        <div class="col-md-5">
                            <label for="">Tanggal Laporan</label>
                            <div class="input-group">
                                <input type="text" class="form-control" value="<?=set_value('tanggal_awal')?>" name="tanggal_awal" autocomplete="off" id="datepicker" placeholder="Tanggal Awal">
                                <div class="input-group-addon">s.d.</div>
                                <input type="text" class="form-control" value="<?=set_value('tanggal_akhir')?>" name="tanggal_akhir" autocomplete="off" id="datepicker" placeholder="Tanggal Akhir">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="">Status</label>
                            <select class="form-control" name="status_verifikasi">
                                <option value="">Semua Status</option>
                                <?php 
                                    $status = array('belum_diverifikasi','sudah_diverifikasi','ditolak');
                                    foreach($status as $s){
                                        $selected = set_value('status_verifikasi') == $s ? ' selected' : '';
                                        echo '<option value="'.$s.'"'.$selected.'>'.normal_string($s).'</option>';
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
                <?php
                if (isset($message)) {
                ?>
                    <div class="alert alert-<?= $message_type ?>"><?= $message ?></div>
                <?php } ?>
                <div class="table-responsive">
                    <table class="table color-table primary-table" id="tableSimple">
                        <thead>
                            <tr>
                                <th class="text-center" width="3%">No.</th>
                                <th width="15%">Hari / Tanggal</th>
                                <th width="20%">Nama Pegawai</th>
                                <th>Rincian Kegiatan</th>
                                <th class="text-center" width="13%">Status</th>
                                <th class="text-center" width="130px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (empty($list)) {
                            ?>
                                <tr>
                                    <td colspan="6">
                                        <center>Data tidak ditemukan</center>
                                    </td>
                                </tr>
                                <?php
                            } else {
                                $no = 1;
                                foreach ($list as $l) {
                                ?>
                                    <tr>
                                        <td class="text-center"><b><?= $no ?></b></td>
                                        <td><?= tanggal_hari($l->tanggal) ?></td>
                                        <td class="text-purple"><?= $l->nama_pegawai ?></td>
                                        <td><?= short_text($l->rincian_kegiatan) ?></td>
                                        <td class="text-center">
                                            <?= status_lkh($l->status_verifikasi) ?>
                                            <?php 
                                                if($l->status_verifikasi=='ditolak'){
                                                    ?>
                                                    <button onclick="detailPenolakan(<?= $l->id_laporan_kerja_harian ?>)" class="btn btn-danger btn-xs btn-rounded">Detail Penolakan</button>
                                                    <?php
                                                }
                                            ?>
                                        </td>
                                        <td class="text-center">
                                            <a data-toggle="tooltip" data-placement="top" title="Detail" href="javascript:void(0)" onclick="editLaporan(<?= $l->id_laporan_kerja_harian ?>)" class="btn btn-primary btn-sm btn-circle"><i class="ti-eye"></i></a>
                                            <?php
                                            if ($l->status_verifikasi !== 'sudah_diverifikasi') {
                                            ?>
                                                <a data-toggle="tooltip" data-placement="top" title="Verifikasi LKH" href="javascript:void(0)" onclick="setujuiLaporan(<?= $l->id_laporan_kerja_harian ?>)" class="btn btn-success btn-sm btn-circle"><i class="ti-check"></i></a>
                                            <?php 
                                                if($l->status_verifikasi=='ditolak'){
                                                    ?>
                                                    <a data-toggle="tooltip" data-placement="top" title="Tolak LKH" href="javascript:void(0)" class="btn btn-danger btn-sm btn-circle  btn-disabled disabled"><i class="ti-close"></i></a>
                                                    <?php
                                                }else{
                                                    ?>
                                                    <a data-toggle="tooltip" data-placement="top" title="Tolak LKH" href="javascript:void(0)" onclick="tolakLaporan(<?= $l->id_laporan_kerja_harian ?>)" class="btn btn-danger btn-sm btn-circle"><i class="ti-close"></i></a>
                                                    <?php
                                                }
                                            ?>
                                            <?php } else { ?>
                                                <a data-toggle="tooltip" data-placement="top" title="Verifikasi LKH" href="javascript:void(0)" class="btn btn-success btn-sm btn-circle btn-disabled disabled"><i class="ti-check"></i></a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                            <?php $no++;
                                }
                            } ?>
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


<div class="modal fade" id="modalVerifikasi" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myLargeModalLabel">Konfirmasi</h4>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin akan memverifikasi Laporan ini? </p>
                <form method="POST" id="formVerifikasi">
                    <input type="hidden" name="status_verifikasi" value="sudah_diverifikasi">
                </form>
            </div>
            <div class="modal-footer">
                <a href="javascript:void(0)" data-dismiss="modal" class="btn btn-default waves-effect text-left">Tidak</a>
                <a href="javascript:void(0)" onclick="saveVerifikasi('Verifikasi')" id="btnVerifikasi" class="btn btn-primary waves-effect text-left">Ya</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<div class="modal fade" id="modalTolak" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myLargeModalLabel">Konfirmasi Penolakan</h4>
            </div>
            <div class="modal-body">
                <form method="POST" id="formTolak">
                    <input type="hidden" name="status_verifikasi" value="ditolak">
                    <textarea class="form-control" name="alasan_penolakan" placeholder="Masukkan Alasan Penolakan"></textarea>
                </form>
            </div>
            <div class="modal-footer">
                <a href="javascript:void(0)" data-dismiss="modal" class="btn btn-default waves-effect text-left">Batal</a>
                <a href="javascript:void(0)" onclick="saveVerifikasi('Tolak')" id="btnTolak" class="btn btn-danger waves-effect text-left">Tolak</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<script>
    var currentIdLaporan;
    function editLaporan(idLaporan) {
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
            $('#modalLaporan').modal('show');
        });
    }
    function detailPenolakan(idLaporan) {
        $.getJSON("<?= base_url('laporan_kinerja_harian/get_detail_json') ?>/" + idLaporan, function(data) {
            $('#alasan_penolakan').html(data.alasan_penolakan);
            $('#modalDetailPenolakan').modal('show');
        });
    }

    function setujuiLaporan(idLaporan) {
        currentIdLaporan = idLaporan;
        // $('#btnVerifikasi').attr('href', '<?= base_url('laporan_kinerja_harian/verifikasi_laporan') ?>/' + idLaporan);
        $('#modalVerifikasi').modal('show');
    }
    function tolakLaporan(idLaporan) {
        currentIdLaporan = idLaporan;
        // $('#btnVerifikasi').attr('href', '<?= base_url('laporan_kinerja_harian/verifikasi_laporan') ?>/' + idLaporan);
        $('#modalTolak').modal('show');
    }

    function saveVerifikasi(status){
        // alert(currentIdLaporan);
		$.post("<?= base_url('laporan_kinerja_harian/saveVerifikasi') ?>/"+currentIdLaporan, $("#form"+status).serialize(),
			function(data) {
				if (data) {
                    swal("Success!", "Status Laporan telah disimpan", "success");
                    window.location.reload(false);
				} else {
					alert('Terjadi kesalahan');
				}
			});
    }
</script>