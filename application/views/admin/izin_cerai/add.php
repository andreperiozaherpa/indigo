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
                <?= form_open_multipart() ?>
        <div class="col-md-8">
            <div class="white-box">
                <h3 class="box-title">Izin Cerai</h3>
                <?php
                if (isset($message)) { ?>
                    <div class="alert alert-<?= $message_type ?>"><?= $message ?></div>
                <?php
                }
                ?>
            
            <?php 
                if(($user_level == "Administrator")){
                ?>
                <div class="form-group">
                    <label>Pegawai</label>
                    <input type="text" class="form-control" placeholder="Pilih Pegawai" name="id_pegawai" required>
                </div>
                <?php }else{
                    ?>
                    <input type="hidden" name="id_pegawai" value="<?=$this->session->userdata('id_pegawai')?>"/>
                    <?php
                }
                ?>
                <div class="form-group">
                    <label>Jenis Tergugat</label>
                    <div style="margin-top:2.5px;margin-bottom:12.5px">
                        <input type="checkbox" value="multi" name="jenis_hari" id="jenis_hari" onchange="togglePeriode()" class="js-switch" data-color="#6003c8" /> Non PNS
                    </div>
                </div>
                <div class="form-group">
                    <label>Nama Tergugat</label>
                    <input type="text" class="form-control" placeholder="Masukkan Nama"required>
                </div>
                <div class="form-group">
                    <label>Perceraian ke -</label>
                    <input type="number" class="form-control" placeholder="Perceraian ke-" name="id_pegawai" required>
                </div>
                <div class="form-group">
                    <label>Keterangan</label>
                    <textarea class="form-control" name="keterangan" placeholder="Masukkan Keterangan" rows="9"></textarea>
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

        <div class="col-md-4">
            <div class="white-box">
                <h3 class="box-title">Berkas Persyaratan</h3>
                <?php 
                  foreach ($persyaratan as $g) {
                    echo ' <div class="form-group ">
                    <label>' . $g->nama_persyaratan . '</label>
                    <input required data-height="80" name="persyaratan_' . $g->id_ref_persyaratan . '" type="file" class="dropify">
                    </div>';
                }
                ?>
            </div>
        </div>
                </form>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('.jenis4').hide();

        <?php 
                if(($user_level == "Administrator")){
                ?>
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
        <?php } ?>
    });

    function cekJenis() {
        var jenis = $('[name="id_ref_jenis_cuti"]').val();
        $('#berkasPersyaratan').html('Memuat persyaratan ...');
        $.get("<?=base_url('izin_cerai/getPersyaratan')?>/"+jenis, function(data) {
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