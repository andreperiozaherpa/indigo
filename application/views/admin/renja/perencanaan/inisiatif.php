<style type="text/css">
    .alert-default {
        border: solid 1px #6003c8;
        color: #6003c8;
        font-weight: 400;
    }
</style>
<div class="container-fluid">

    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Sasaran Inisiatif</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="">Ren. Kerja</a></li>
                <li class="active">Sasaran Inisiatif</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
            <?php 
                if(isset($message)){
                    ?>
                    <div class="alert alert-<?=$message_type?>">
                    <?=$message?>
                    </div>
                    <?php
                }
            ?>
                <form method="POST">
                <h3 class="box-title text-purple">Tambah Sasaran Inisiatif</h3>
                <div class="form-group">
                    <label>Jenis Sasaran</label>
                    <select style="color:#6003c8;font-weight:500" class="form-control" name="jenis_sasaran" onchange="toggleJenis()" required>
                        <option value="">Pilih Jenis Sasaran</option>
                        <?php
                        foreach ($jenis_sasaran as $k => $s) {
                            echo '<option value="' . $k . '">' . normal_string($s) . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group" id="divUnitKerja" style="display: none;">
                    <label>Unit Kerja</label>
                    <select class="form-control select2" name="id_unit_kerja">
                        <option value="">Pilih Unit Kerja</option>
                        <?php
                        foreach ($unit_kerja as $u) {
                            echo '<option value="' . $u->id_unit_kerja . '">' . $u->nama_unit_kerja . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div id="divStrategis" style="display: none;">
                    <div class="form-group">
                        <label for="data-id_misi" class="control-label">Misi</label>
                        <select id="data-id_misi" class="form-control" onchange="get_tujuan()">
                            <option value="">Pilih Misi</option>
                            <?php foreach ($misi as $key) : ?>
                                <option value="<?= $key->id_misi ?>"><?= $key->misi ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="data-id_tujuan" class="control-label">Tujuan</label>
                        <select id="data-id_tujuan" name="id_tujuan" class="form-control">
                            <option value="">Pilih Tujuan</option>
                        </select>
                    </div>
                </div>
                <div id="divProgram" style="display: none;">
                    <div class="form-group">
                        <label>IKU Sasaran Strategis</label>
                        <select class="form-control" name="id_iku_ss_renstra">
                            <option value="">Pilih IKU Sasaran Strategis</option>
                        </select>
                    </div>
                </div>
                <div id="divKegiatan" style="display: none;">
                    <div class="form-group">
                        <label>IKU Sasaran Program</label>
                        <select class="form-control" name="id_iku_sp_renstra">
                            <option value="">Pilih IKU Sasaran Program</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label>Nama Sasaran</label>
                    <input type="text" class="form-control" name="nama_sasaran" placeholder="Masukkan Nama Sasaran" required>
                </div>

                <div id="formIndikator">
                    <div class="div-indikator" style="border:solid 1px #e4e7ea;border-top:solid 5px #6003c8;margin-bottom:10px" id="indikator0">
                        <h3 class="box-title" style="color: #fff;background-color:#6003c8;width:150px;padding-left:10px;border-radius:0px 0px 30px 0px" id="lblIndikator">Indikator 1</h3>
                        <div style="padding:0px 10px 10px 10px">
                            <div class="form-group">
                                <label>Nama Indikator</label>
                                <input type="text" name="nama_indikator[]" class="form-control" placeholder="Masukkan Nama Indikator" required>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Satuan Pengukuran</label>
                                        <select name="id_satuan[]" class="form-control select2" required>
                                            <option value="">Pilih Satuan Pengukuran</option>
                                            <?php foreach ($ref_satuan as $key => $value) : ?>
                                                <option value="<?= $value->id_satuan ?>"><?= $value->satuan ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Target</label>
                                        <input type="text" name="target[]" class="form-control" placeholder="Masukkan Target" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-sm-12">Polorarisasi</label>
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                <div class="radio radio-primary">
                                                    <input type="radio" class="pol" name="polorarisasi_0" id="radio00" value="Maximaze" checked required>
                                                    <label for="radio00" id="lblRadio"> Maximaze </label> <span class="badge badge-info " data-toggle="popover" data-placement="top" data-content="adalah kondisi bila realisasi kinerja harus lebih besar dari pada target, atau semakin besar hasil realisasi kinerja maka nilai capaian dari target tersebut semakin bagus. Contohnya : target jumlah pendapatan daerah (bisa menggunakan maximize)"><i class="ti-info" style="font-size:9px"></i></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                <div class="radio radio-primary">
                                                    <input type="radio" class="pol" name="polorarisasi_0" id="radio01" value="Minimaze" required>
                                                    <label for="radio01" id="lblRadio"> Minimaze </label> <span class="badge badge-info" data-toggle="popover" data-placement="top" data-content="adalah kondisi bila realisasi kinerja harus lebih kecil dari pada target, atau semakin kecil hasil realisasi kinerja maka nilai capaian dari target tersebut semakin bagus. Contohnya : target jumlah kematian bayi (bisa menggunakan minimize)"><i class="ti-info" style="font-size:9px"></i></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                <div class="radio radio-primary">
                                                    <input type="radio" class="pol" name="polorarisasi_0" id="radio02" value="Stabilize" required>
                                                    <label for="radio02" id="lblRadio"> Stabilize </label> <span class="badge badge-info" data-toggle="popover" data-placement="top" data-content="adalah kondisi bila realisasi kinerja harus mendekati nilai dari pada target, atau semakin kecil selisih antara  realisasi dan target, maka capaian tersebut semakin bagus. Contohnya : target penyerapan anggaran (bisa menggunakan stabilize)"><i class="ti-info" style="font-size:9px"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Cascading</label>
                                        <select name="id_unit_kerja_casecading_0[]" class="select2" multiple="multiple" required>
                                            <?php
                                            foreach ($unit_kerja as $u) {
                                                echo '<option value="' . $u->id_unit_kerja . '">' . $u->nama_unit_kerja . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="javascript:void(0)" id="btnAddRow" onclick="addRow()" class="text-purple" style="font-weight: 500;padding:10px;"><i class="ti-plus"></i> Tambah Indikator</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary pull-right"><i class="ti-save"></i> Simpan</button>   
                        <a href="" class="btn btn-outline btn-primary pull-right" style="margin-right:10px">Batal</a>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function toggleJenis() {
        var jenis = $('[name="jenis_sasaran"]').val();
        if (jenis !== '') {
            if (jenis == 'ss') {
                $('#divUnitKerja').fadeOut(300);
                $('#divStrategis').fadeIn(300);
                $('#divProgram').fadeOut(300);
                $('#divKegiatan').fadeOut(300);
                $('[name="id_tujuan"]').removeAttr('disabled');
                $('[name="id_tujuan"]').attr('required','required');
                $('[name="id_unit_kerja"]').attr('disabled','disabled');
                $('[name="id_iku_ss_renstra"]').attr('disabled','disabled');
                $('[name="id_iku_sp_renstra"]').attr('disabled','disabled');
                $('[name="id_unit_kerja"]').removeAttr('required');
                $('[name="id_iku_ss_renstra"]').removeAttr('required');
                $('[name="id_iku_sp_renstra"]').removeAttr('required');
                $('[name="id_unit_kerja"]').removeAttr('onchange');
            } else if (jenis == 'sp') {
                $('#divUnitKerja').fadeIn(300);
                $('#divStrategis').fadeOut(300);
                $('#divProgram').fadeIn(300);
                $('#divKegiatan').fadeOut(300);
                $('[name="id_tujuan"]').attr('disabled','disabled')
                $('[name="id_tujuan"]').removeAttr('required')
                $('[name="id_unit_kerja"]').removeAttr('disabled');
                $('[name="id_unit_kerja"]').attr('required','required');
                $('[name="id_iku_ss_renstra"]').removeAttr('disabled');
                $('[name="id_iku_ss_renstra"]').attr('required','required');
                $('[name="id_iku_sp_renstra"]').attr('disabled','disabled');
                $('[name="id_iku_sp_renstra"]').removeAttr('required')
                $('[name="id_unit_kerja"]').attr('onchange', "getIkuUnitKerja('ss')");
            } else if (jenis == 'sk') {
                $('#divUnitKerja').fadeIn(300);
                $('#divStrategis').fadeOut(300);
                $('#divProgram').fadeOut(300);
                $('#divKegiatan').fadeIn(300);
                $('[name="id_tujuan"]').attr('disabled','disabled')
                $('[name="id_tujuan"]').removeAttr('required')
                $('[name="id_unit_kerja"]').removeAttr('disabled');
                $('[name="id_unit_kerja"]').attr('required','required');
                $('[name="id_iku_ss_renstra"]').attr('disabled','disabled')
                $('[name="id_iku_ss_renstra"]').removeAttr('required');
                $('[name="id_iku_sp_renstra"]').removeAttr('disabled');
                $('[name="id_iku_sp_renstra"]').attr('required','required');
                $('[name="id_unit_kerja"]').attr('onchange', "getIkuUnitKerja('sp')");
            }
        } else {
            $('#divUnitKerja').fadeOut(300);
            $('#divStrategis').fadeOut(300);
            $('#divProgram').fadeOut(300);
            $('#divKegiatan').fadeOut(300);
        }
    }


    function addRow() {
        var last = $('.div-indikator:last');
        var next = $('.div-indikator').length;
        var now = next - 1;
        if ($('[name="id_unit_kerja_casecading_'+now+'[]"]').data('select2')) {
            $('[name="id_unit_kerja_casecading_'+now+'[]"]').select2("destroy");
        }
        if ($('[name="id_satuan[]"]').data('select2')) {
            $('[name="id_satuan[]"]').select2("destroy");
        }
        var clone = $(last).clone();
        clone.find('#lblIndikator').html('Indikator ' + parseInt(next + 1));
        $(clone.find('.pol')).each(function(k, v) {
            $(this).attr('id', 'radio' + next + k);
            $(this).attr('name', 'polorarisasi_' + next);
        });
        $(clone.find('#lblRadio')).each(function(k, v) {
           $(this).attr('for', 'radio' + next + k);
        });
        clone.find('.pol').prop('checked',false);
        clone.find('[name="id_unit_kerja_casecading_'+now+'[]"]').attr('name','id_unit_kerja_casecading_'+next+'[]');
        clone.find('[name="id_unit_kerja_casecading_'+next+'[]"]').val('');
        clone.find('[name="nama_indikator[]"]').val('');
        clone.find('[name="target[]"]').val('');
        clone.find('[name="id_unit_kerja_casecading[]"]').val('');
        clone.find('[name="id_satuan[]"]').val('');
        $('#btnAddRow').remove();
        $('#formIndikator').append(clone);
        $('[name="polorarisasi_' + next +'"]').first().prop('checked',true);
        $('[name="id_unit_kerja_casecading_'+now+'[]"]').select2();
        $('[name="id_unit_kerja_casecading_'+next+'[]"]').select2();
        $('[name="id_satuan[]"]').select2();
    }

    function get_tujuan(id_misi = null) {
        if (id_misi == null) {
            var id_misi = $("#data-id_misi").val();
        }
        $("#data-id_tujuan").attr("readonly", true);
        $.ajax({
            url: "<?php echo base_url('sasaran_rpjmd/get_tujuan_by_misi'); ?>",
            type: "GET",
            data: "id_misi=" + id_misi,
            dataType: "text",

            success: function(resp) {
                $("#data-id_tujuan").attr("readonly", false);
                $("#data-id_tujuan").html(resp);
            },
            error: function(event, textStatus, errorThrown) {
                alert('Error Message: ' + textStatus + ' , HTTP Error: ' + errorThrown);
                $("#data-modal").unblock();
                $("#data-id_tujuan").html("");
                $("#data-id_tujuan").attr("readonly", true);
            }
        });
    }

    function getIkuUnitKerja(jenis) {
        var id_unit_kerja = $('[name="id_unit_kerja"]').val();
        if (id_unit_kerja !== '') {
            $.getJSON("<?php echo base_url('renja_perencanaan/getIkuUnitKerja'); ?>/" + jenis + "/" + id_unit_kerja + "/<?= $tahun ?>", function(data) {
                var id = 'id_iku_' + jenis + '_renstra';
                var nama = 'iku_' + jenis + '_renstra';
                var html;
                html += '<option value="">Pilih IKU ' + data.jenis + '</option>';
                $.each(data.detail, function(k, v) {
                    html += '<option value="' + v[id] + '">' + v[nama] + '</option>';
                });
                $('[name="' + id + '"]').html(html);
            });
        }
    }
</script>