<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><?= $title ?></h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <?php echo breadcrumb($this->uri->segment_array()); ?>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div class="row">
        
    <div class="col-md-12">
            <a href="<?=base_url('izin_cerai/detail/'.$detail->id_izin_cerai)?>" class="btn btn-outline btn-primary pull-right" >Kembali</a>
            <br><br>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?= form_open_multipart() ?>
            <div class="white-box">
                <h3 class="box-title">EDIT Izin Cerai</h3>
                <?php
                if (isset($message)) { ?>
                    <div class="alert alert-<?= $message_type ?>"><?= $message ?></div>
                <?php
                }
                ?>
                <div class="form-group">
                    <label>Pegawai</label>
                    <p><?= $detail->nama_lengkap ?></p>
                </div>
                <div class="form-group">
                    <label>Keterangan</label>
                    <textarea class="form-control" name="keterangan" placeholder="Masukkan Keterangan" rows="9"><?= $detail->keterangan ?></textarea>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="m-l-10 btn btn-primary pull-right"><span class="btn-label"><i class="ti-save"></i></span> Simpan</button>
                            <a href="<?= base_url('izin_cerai') ?>" class="btn btn-outline btn-primary pull-right"><span class="btn-label"><i class="ti-back-left"></i></span> Kembali</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        </form>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('.jenis4').hide();

        $('[name="id_pegawai"]').select2({
            minimumInputLength: 2,
            allowClear: true,
            placeholder: 'Pilih Pegawai',
            ajax: {
                dataType: 'json',
                url: '<?= base_url('absensi/log/get_pegawai') ?>',
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
        if ($detail->jenis_tanggal !== "single") {
        ?>
            $('#jenis_hari').prop('checked', 'checked');
            togglePeriode();
        <?php
        }
        ?>
    });

    function cekJenis() {
        var jenis = $('[name="id_ref_jenis_cuti"]').val();
        $('#berkasPersyaratan').html('Memuat persyaratan ...');
        $.get("<?= base_url('izin_cerai/getPersyaratan') ?>/" + jenis, function(data) {
            $('#berkasPersyaratan').html(data);
            $('.dropify').dropify();
        });
    }

    function togglePeriode() {
        // alert('aasd');
        var checked = $('#jenis_hari').prop('checked');
        if (checked) {
            $('#periodeMulti').show();
            $('#periodeSingle [name="tanggal_awal"]').attr('disabled', 'disabled');
            $('#periodeSingle').hide();
            $('#periodeMulti [name="tanggal_awal"]').removeAttr('disabled');
        } else {
            $('#periodeMulti').hide();
            $('#periodeSingle [name="tanggal_awal"]').removeAttr('disabled');
            $('#periodeSingle').show();
            $('#periodeMulti [name="tanggal_awal"]').attr('disabled', 'disabled');
        }
    }
</script>