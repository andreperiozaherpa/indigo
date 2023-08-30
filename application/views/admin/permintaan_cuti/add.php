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
                <h3 class="box-title">BUAT Permintaan Cuti</h3>
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
                    <label>Jenis Cuti yang diambil</label>
                    <select name="id_ref_jenis_cuti" onchange="cekJenis()" class="form-control select2" required>
                        <option value="">Pilih Jenis Cuti</option>
                        <?php
                        // $cuti = array('Cuti Alasan Penting', 'Cuti Besar', 'Cuti Melahirkan', 'Cuti di Luar Tanggungan Negara');
                        foreach ($jenis_cuti as $j) {
                            echo '<option value="' . $j->id_ref_jenis_cuti . '">' . $j->nama_jenis_cuti . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Alasan Cuti</label>
                    <textarea class="form-control" name="keterangan" placeholder="Masukkan Alasan Cuti" rows="5"></textarea>
                </div>
                <div class="form-group">
                    <label>Periode Cuti</label>
                    <div style="margin-top:2.5px;margin-bottom:12.5px">
                        <input type="checkbox" value="multi" name="jenis_hari" id="jenis_hari" onchange="togglePeriode()" class="js-switch" data-color="#6003c8" /> Lebih dari 1 hari
                    </div>
                    <div id="periodeMulti" style="display: none;">
                        <div class="input-group">
                            <input type="text" name="tanggal_awal" onchange="initTglAkhir()" id="datepicker" class="form-control dateLogAwal" autocomplete="off" id="" placeholder="Pilih Tanggal Awal">
                            <span class="input-group-addon">s.d</span>
                            <input type="text" name="tanggal_akhir" id="datepicker" class="form-control dateLogAkhir" autocomplete="off" id="" placeholder="Pilih Tanggal Akhir">
                        </div>
                    </div>
                    <div id="periodeSingle">
                        <input type="text" name="tanggal_awal" class="form-control" autocomplete="off" id="datepicker" placeholder="Pilih Tanggal Cuti">
                    </div>

                </div>

                <div class="form-group">
                    <label>Alamat selama menjalankan Cuti</label>
                    <textarea class="form-control" name="alamat" placeholder="Masukkan Alamat" rows="9"></textarea>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="m-l-10 btn btn-primary pull-right"><span class="btn-label"><i class="ti-save"></i></span> Simpan</button>
                            <a href="<?= base_url('permintaan_cuti') ?>" class="btn btn-outline btn-primary pull-right"><span class="btn-label"><i class="ti-back-left"></i></span> Kembali</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-md-4">
            <div class="white-box">
                <h3 class="box-title">Berkas Persyaratan</h3>
                <div id="berkasPersyaratan">
                        <div class="alert alert-info">
                            Silahkan pilih jenis cuti terlebih dahulu
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
        <?php 
                if(($user_level == "Administrator")){
                ?>
        $('[name="id_pegawai"]').select2({
            minimumInputLength: 2,
            allowClear: true,
            placeholder: 'Pilih Pegawai',
            ajax: {
                dataType: 'json',
                url: '<?= base_url('absensi/log/get_pegawai_current') ?>',
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
        $.get("<?=base_url('permintaan_cuti/getPersyaratan')?>/"+jenis, function(data) {
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