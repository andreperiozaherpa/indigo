<div class="container-fluid">

    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Pengaturan Penandatangan</h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

            <ol class="breadcrumb">
                <li><a href="https://e-office.sumedangkab.go.id/admin">Dashboard</a></li>
                <li><a href="https://e-office.sumedangkab.go.id/kegiatan_personal">Perjalanan Dinas</a></li>
                <li class="active">Penandatangan</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <h3 class="box-title">PENGATURAN PENANDATANGAN DOKUMEN PERJALANAN DINAS</h3>
                <?php
                if (isset($message)) {
                ?>
                    <div class="alert alert-<?= $message_type ?>"><?= $message ?></div>
                <?php
                }
                ?>
                <form method="POST">
                    <?php
                    foreach ($list as $k => $l) {
                    ?>
                        <div class="form-group">
                            <label><?= $l->nama_ttd ?></label>
                            <input type="text" name="idpegawai_<?= $l->id_perjalanan_dinas_ttd ?>" class="form-control">
                        </div>
                    <?php } ?>
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

    $(document).ready(function() {
        <?php
        foreach ($list as $k => $l) {
        ?>
            $('[name="idpegawai_<?= $l->id_perjalanan_dinas_ttd ?>"]').select2({
                minimumInputLength: 2,
                allowClear: true,
                placeholder: 'Pilih Pegawai <?=$l->nama_ttd?>',
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

            <?php 
                if(!empty($l->id_pegawai)){
            ?>
            var ALL_OPTION<?= $l->id_perjalanan_dinas_ttd ?> = {
                id: '<?= $l->id_pegawai ?>',
                text: '<?= $l->nama_lengkap ?>'
            };

            $('[name="idpegawai_<?= $l->id_perjalanan_dinas_ttd ?>"]').select2('data', ALL_OPTION<?= $l->id_perjalanan_dinas_ttd ?>);
        <?php  } } ?>
    });
</script>