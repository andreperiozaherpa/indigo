<?php 
 
 if($this->session->userdata('level') == 'Administrator' || in_array('admin_simanja', $user_privileges)){
   $id_skpd = null;
 }else{
   $id_skpd = $this->session->userdata('id_skpd');
 }
 $jenis_jabatan = null;
 
 if(isset($_GET['id_skpd'])){
   $id_skpd = $_GET['id_skpd'];
 }

 if(isset($_GET['jenis_jabatan'])){
   $jenis_jabatan = $_GET['jenis_jabatan'];
 }

?>
<div class="container-fluid">

    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Analisis Jabatan</h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

            <ol class="breadcrumb">
                <li><a href="<?= base_url(); ?>admin">Dashboard</a></li>
                <li class="active">Analisis Jabatan</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
    <!-- .row -->
    <div class="row">
        <div class="col-md-12">
            <?php if($this->session->userdata('level') == 'Administrator' || in_array('admin_simanja', $user_privileges)): ?>
            <div class="row">
                <div class="col-md-3 col-xs-12 col-sm-6">
                    <div class="white-box text-center bg-purple">
                        <h1 class="text-white counter">54</h1>
                        <p class="text-white">OPD</p>
                    </div>
                </div>
                <div class="col-md-3 col-xs-12 col-sm-6">
                    <a href="<?=base_url('simanja/analisis_jabatan?id_skpd='.$id_skpd.'&jenis_jabatan=Struktural')?>">
                        <div class="white-box text-center" style="background-color: #009457">
                            <h1 class="text-white counter"><?=$count_struktural?></h1>
                            <p class="text-white">Struktural</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-xs-12 col-sm-6">
                    <a href="<?=base_url('simanja/analisis_jabatan?id_skpd='.$id_skpd.'&jenis_jabatan=Fungsional')?>">
                        <div class="white-box text-center" style="background-color: #FFC630">
                            <h1 class="text-white counter"><?=$count_fungsional?></h1>
                            <p class="text-white">Fungsional</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-xs-12 col-sm-6">
                    <a href="<?=base_url('simanja/analisis_jabatan?id_skpd='.$id_skpd.'&jenis_jabatan=Pelaksana')?>">
                        <div class="white-box text-center" style="background-color: #1E88E5">
                            <h1 class="text-white counter"><?=$count_pelaksana?></h1>
                            <p class="text-white">Pelaksana</p>
                        </div>
                    </a>
                </div>
            </div>
            <?php endif; ?>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Analisis Jabatan
                            <span class="label label-primary pull-right m-l-10"> <button type="button"
                                    class="btn btn-primary btn-sm" onclick="addRef()"><i class="fa fa-plus"></i>
                                    Tambah</button></span>
                            <?php if($this->session->userdata('level') == 'Administrator'){ ?>
                            <span class="label label-success pull-right m-l-10"><button class="btn btn-success btn-sm"
                                    onclick="showImportExcel()"> <i class="fa fa-download"></i> Import
                                    Excel</button></span>
                            <?php } ?>
                            <?php if($id_skpd != null || $jenis_jabatan != null){ ?>
                            <span class="label label-warning pull-right m-l-10"> <a
                                    href="<?=base_url('simanja/analisis_jabatan?id_skpd=&jenis_jabatan=')?>"
                                    class="btn btn-warning btn-sm"><i class="fa fa-refresh"></i> Reset Filter</a></span>
                            <?php } ?>
                        </div>
                        <form method="POST" enctype="multipart/form-data" style="display:none">
                            <input type="file" name="fileExcel" id="import_excel" onchange="this.form.submit()">
                            <button type="submit" name="excel"></button>
                        </form>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <?php if($this->session->flashdata('status')){ ?>
                                <div class="alert alert-success">
                                    <?=$this->session->flashdata('status')?>
                                </div>
                                <?php } ?>
                                <?php if($this->session->userdata('level') == 'Administrator' || in_array('admin_simanja', $user_privileges)): ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <form method="GET">
                                            <div class="form-group">
                                                <label for="">OPD</label>
                                                <select class="form-control select2" name="id_skpd"
                                                    onchange="this.form.submit()">
                                                    <option value=""> Semua OPD </option>
                                                    <?php foreach($skpd as $i) { ?>
                                                    <option value="<?=$i->id_skpd?>"
                                                        <?=($id_skpd == $i->id_skpd) ? 'selected' : null?>>
                                                        <?=$i->nama_skpd?> </option>
                                                    <?php } ?>
                                                </select>
                                                <input type="hidden" name="jenis_jabatan" value="<?=$jenis_jabatan?>">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <?php if(in_array('admin_simanja', $user_privileges) || $user_level == 'Administrator') { ?>
                                        <a href="<?=base_url('simanja/analisis_jabatan/kunci_semua/tutup')?>"
                                            class="btn btn-warning"><i class="fa fa-lock"></i> Tutup kunci semua
                                            OPD</a>
                                        <a href="<?=base_url('simanja/analisis_jabatan/kunci_semua/buka')?>"
                                            class="btn btn-success"><i class="fa fa-unlock"></i> Buka kunci semua
                                            OPD</a>
                                        <?php } ?>
                                        <?php if($id_skpd != null){ ?>
                                        <a href="<?=base_url('simanja/analisis_jabatan/kunci_semua/tutup/'.$id_skpd)?>"
                                            class="btn btn-warning"><i class="fa fa-lock"></i> Tutup kunci OPD</a>
                                        <a href="<?=base_url('simanja/analisis_jabatan/kunci_semua/buka/'.$id_skpd)?>"
                                            class="btn btn-success"><i class="fa fa-unlock"></i> Buka kunci OPD</a>
                                        <a href="<?=base_url('simanja/analisis_jabatan/peta_jabatan/'.$id_skpd)?>"
                                            target="_blank" class="btn btn-info"><i class="fa fa-users"></i>Peta
                                            Jabatan</a>
                                        <?php } ?>
                                    </div>
                                </div>
                                <br>
                                <table class="table color-table dark-table table-hover" id="myTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama</th>
                                            <th>Jenis</th>
                                            <th>SKPD/OPD</th>
                                            <th>Kelas</th>
                                            <th>B</th>
                                            <th>K</th>
                                            <th>S</th>
                                            <th>Progress</th>
                                            <th>Atasan Langsung</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                   $no = 1;
                   foreach ($list as $i) {
                   ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $i->nama ?>
                                                <?= ($i->jenis_jabatan == 'Struktural') ? '<b>('.$i->jenis_pegawai.')</b>' : null ?>
                                            </td>
                                            <td><span class="badge"
                                                    style="background-color: <?=($i->jenis_jabatan == 'Struktural') ? '#009457' : (($i->jenis_jabatan == 'Fungsional') ? '#FFC630' : '#1E88E5') ?> !important"><?= $i->jenis_jabatan ?></span>
                                            </td>
                                            <td><?= $i->nama_skpd ?></td>
                                            <td><?=$i->kelas?></td>
                                            <td><?=$i->jumlah_pemangku?></td>
                                            <td><?=$i->jumlah_kebutuhan_pegawai?></td>
                                            <td><?=$i->jumlah_pemangku - $i->jumlah_kebutuhan_pegawai?></td>
                                            <td>
                                                <label id="w0"
                                                    class="label <?=($i->nilai > 0) ? ($i->nilai > 80) ? 'label-success' : 'label-info' : 'label-danger'?>"><?=$i->nilai ? number_format($i->nilai, 0, '.', '') : 0?>%</label>
                                            </td>
                                            <td><?=$i->namaIndukJabatan?></td>

                                            <td style="width:150px">
                                                <!-- <a href="javascript:void(0)" onclick="editRef(<?= $i->id ?>)" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></a> -->
                                                <?php
                        if(in_array('admin_simanja', $user_privileges) || $user_level == 'Administrator') {
                          if($i->status == 'buka'){ ?>
                                                <a href="<?=base_url('simanja/analisis_jabatan/kunci/'.$i->id)?>"
                                                    class="btn btn-success btn-sm" title="Klik untuk menutup kunci"><i
                                                        class="fa fa-unlock"></i></a>
                                                <?php } else { ?>
                                                <a href="<?=base_url('simanja/analisis_jabatan/kunci/'.$i->id)?>"
                                                    class="btn btn-warning btn-sm" title="Klik untuk membuka kunci"><i
                                                        class="fa fa-lock"></i></a>
                                                <?php } }
                          ?>
                                                <a href="<?=base_url('simanja/analisis_jabatan/detail/'.$i->id)?>"
                                                    class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                                                <?php if(in_array('admin_simanja', $user_privileges) || $user_level == 'Administrator' || in_array('simanja', $user_privileges)) { ?>
                                                <a href="javascript:void(0)" onclick="deleteRef(<?= $i->id ?>)"
                                                    class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <?php $no++;
                   } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- .row -->

    </div>
</div>

<div id="modalReferensi" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel1">Ubah</h4>
            </div>
            <div class="modal-body">
                <form id="formRef">
                    <div id="hiddenRef"></div>
                    <div id="messageRef"></div>
                    <div class="form-group">
                        <label for="message-text" class="control-label">Jenis Jabatan <sup class="text-danger"
                                title="wajib diisi">*</sup></label>
                        <select class="form-control" id="jenis_jabatan" name="jenis_jabatan"
                            onchange="jenisPegawaiChange(this.value)" required>
                            <option value="">-- Pilih --</option>
                            <option value="Struktural">Struktural</option>
                            <option value="Fungsional">Fungsional</option>
                            <option value="Pelaksana">Pelaksana</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="control-label">Nama <sup class="text-danger"
                                title="wajib diisi">*</sup> </label>
                        <div id="name_struktural" style="display:none'">
                            <input type="text" name="nama" id="nama_1" class="form-control"
                                placeholder=" Masukkan Nama Jabatan">
                        </div>
                        <div id="name_other" style="display:none">
                            <select class="form-control select2" name="id_ref_jabatan" id="nama"
                                onchange="chooseJabatanOther(this.value)">
                                <option value="">-- Pilih --</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="control-label">OPD/SKPD</label>
                        <select class="form-control select2" onchange="unitKerja(this.value)" id="id_skpd"
                            name="id_skpd">
                            <option value="">-- Pilih --</option>
                            <?php foreach($skpd as $i){ ?>
                            <?php if($this->session->userdata('level') == 'Administrator' || in_array('admin_simanja', $user_privileges)){ ?>
                            <option value="<?=$i->id_skpd?>" data-type="<?=$i->jenis_skpd?>"><?=$i->nama_skpd?></option>
                            <?php }else{ ?>
                            <?php if($id_skpd == $i->id_skpd) { ?>
                            <option value="<?=$i->id_skpd?>" data-type="<?=$i->jenis_skpd?>" selected><?=$i->nama_skpd?>
                            </option>
                            <?php } ?>
                            <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group" style="display: none" id="jenis_pegawai_fg">
                        <label for="message-text" class="control-label">Jenis ASN <sup class="text-danger"
                                title="wajib diisi">*</sup></label>
                        <select class="form-control" id="jenis_pegawai" name="jenis_pegawai" required>
                            <option value="">-- Pilih --</option>
                            <option value="JPT Pratama">JPT Pratama</option>
                            <option value="Administrator">Administrator</option>
                            <option value="Pengawas">Pengawas</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="control-label">JPT Pratama</label>
                        <select class="form-control select2" id="jpt_pratama" name="jpt_pratama"
                            onchange="unitKerjaInduk(this.value, 'Administrator')">
                            <option value="">-- Pilih --</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="control-label">Administrator</label>
                        <select class="form-control select2" id="administrator" name="administrator"
                            onchange="unitKerjaIndukPengawas(this.value)">
                            <option value="">-- Pilih --</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="control-label">Pengawas</label>
                        <select class="form-control select2" id="pengawas" name="pengawas">
                            <option value="">-- Pilih --</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="control-label">Eselon Jabatan</label>
                        <select id="eselon_jabatan" class="form-control" name="eselon_jabatan">
                            <option value="">-- Pilih --</option>
                            <option value="II/a">II/a</option>
                            <option value="II/b">II/b</option>
                            <option value="III/a">III/a</option>
                            <option value="III/b">III/b</option>
                            <option value="IV/a">IV/a</option>
                            <option value="IV/b">IV/b</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="control-label">Ikhtisar Jabatan</label>
                        <textarea name="ikhtisar_jabatan" class="form-control" rows="5"></textarea>
                    </div>
                    <!-- <div class="form-group">
              <label for="message-text" class="control-label">Urutan</label>
              <input type="number" name="urutan" class="form-control" placeholder="Masukkan Urutan Jabatan" <?=$disabled?>>
            </div> -->
                    <!-- <div class="form-group">
              <label for="message-text" class="control-label">Status</label>
              <select class="form-control" name="status">
                <option value="Buka">Buka</option>
                <option value="Kunci">Kunci</option>
              </select>
            </div> -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" onclick="simpanRef()" id="btnSaveRef" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
</div>


<script type="text/javascript">
var save_method;

function addRef() {
    save_method = 'add';
    $('#formRef')[0].reset();
    $('#messageRef').html('');
    $('#modalReferensi').modal('show');
    $('.modal-title').text('Tambah Jabatan');
}

function jenisPegawaiChange(val) {
    $('#jenis_pegawai_fg').hide();
    $('#name_struktural').hide();
    $('#name_other').hide();
    if (val == 'Struktural') {
        $('#jenis_pegawai_fg').show();
        $('#name_struktural').show();
        $('#name_struktural').trigger('change');
    } else {
        $('#name_other').show();
        $('#name_other').trigger('change');
        $.ajax({
            url: "<?= base_url() . 'simanja/analisis_jabatan/fetch_jabatan/' ?>" + val,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                let html = ''
                data.forEach((e, i) => {
                    html += '<option value="' + e.id + '">' + e.nama + '</option>'
                })

                $('#nama').html(html)
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Gagal mendapatkan data");
            }
        })
    }
}

function unitKerja(id) {
    let type = $("#id_skpd").select2().find(":selected").data('type');
    if (type == 'skpd' && id != '') {
        $.ajax({
            url: "<?= base_url() . 'simanja/analisis_jabatan/fetch_unit_kerja/' ?>" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('#jpt_pratama').val("").change();
                let html = '<option value="">-- Pilih --</option>'
                data.forEach((e, i) => {
                    html += '<option value="' + e.id + '">' + e.nama + '</option>'
                })
                $('#jpt_pratama').html(html)
                $('#administrator').val("").change();
                $('#pengawas').val("").change();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Gagal mendapatkan data");
            }
        })
    } else {
        $('#jpt_pratama,#administrator,#pengawas').each(function() {
            $(this).empty()
                .append('<option value="">-- Pilih --</option>')
                .val('').change()
        })
        if (type == 'kecamatan') {
            unitKerjaInduk(id)
        } else if (type == 'kelurahan' || type == 'uptd') {
            unitKerjaIndukPengawas(id)
        }
    }
}

function unitKerjaInduk(id, jj) {
    let type = $("#id_skpd").select2().find(":selected").data('type');
    if (id !== '') {
        let url = 'simanja/analisis_jabatan/fetch_unit_kerja_induk/' + id + '/' + jj;
        if (type === 'kecamatan') {
            url = 'simanja/analisis_jabatan/fetch_unit_kerja_induk_type/' + id + '/Administrator';
        }
        $.ajax({
            url: "<?= base_url()?>" + url,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('#administrator').val("");
                $('#administrator').trigger('change');
                $('#pengawas').val("");
                $('#pengawas').trigger('change');
                let html = '<option value="">-- Pilih --</option>'
                data.forEach((e, i) => {
                    html += '<option value="' + e.id + '">' + e.nama + '</option>'
                })
                $('#administrator').html(html)
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Gagal mendapatkan data");
            }
        })
    } else {
        $('#administrator,#pengawas').each(function() {
            $(this).empty()
                .append('<option value="">-- Pilih --</option>')
                .val('').change()
        })
    }
}

function chooseJabatanOther(id) {
    $.ajax({
        url: "<?= base_url() . 'simanja/analisis_jabatan/fetch_jabatan_id/' ?>" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            $('#nama_1').val(data.nama);
            $('[name="ikhtisar_jabatan"]').val(data.tugas);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert("Gagal mendapatkan data");
        }
    })
}

function unitKerjaIndukPengawas(id) {
    let val = $('#administrator').val();
    let type = $("#id_skpd").select2().find(":selected").data('type');
    if (typeof val === 'string' || val !== '' || type === 'kelurahan' || type === 'uptd') {
        let url = 'simanja/analisis_jabatan/fetch_unit_kerja_induk/' + id;
        if (type === 'kelurahan' || type === 'uptd') {
            url = 'simanja/analisis_jabatan/fetch_unit_kerja_induk_type/' + id + '/Pengawas';
        }
        $.ajax({
            url: "<?= base_url()?>" + url,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('#pengawas').val("");
                $('#pengawas').trigger('change');
                let html = '<option value="">-- Pilih --</option>';
                data.forEach((e, i) => {
                    html += '<option value="' + e.id + '">' + e.nama + '</option>'
                })
                $('#pengawas').html(html)
                $('#pengawas').val("");
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Gagal mendapatkan data");
            }
        })
    } else {
        $('#pengawas').empty().append('<option value="">-- Pilih --</option>')
            .val('').change()
    }
}

function editRef(id) {
    save_method = 'update';
    $('#formRef')[0].reset();
    $('#messageRef').html('');
    $('.form-group').removeClass('has-error');
    $('#hiddenRef').html('<input type="hidden" value="" name="id_ref"/>');
    $('.help-block').empty();
    $.ajax({
        url: "<?= base_url() . 'simanja/analisis_jabatan/fetch_ref/' ?>" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data) {

            if (data.id_skpd) {
                $('[name="id_skpd"]').val(data.id_skpd);
                let event = jQuery.Event("change");
                $('[name="id_skpd"]').trigger(event);
                if (!event.isDefaultPrevented()) {
                    $('[name="administrator"]').val(data.administrator);
                    setTimeout(function() {
                        $('[name="administrator"]').trigger('change');
                    }, 1000)
                    $('[name="pengawas"]').val(data.pengawas);
                    setTimeout(function() {
                        $('[name="pengawas"]').trigger('change');
                    }, 2000)
                }
            }

            $('[name="id_ref"]').val(data.id);
            $('[name="nama"]').val(data.nama);
            $('[name="eselon_jabatan"]').val(data.eselon_jabatan);
            $('[name="jenis_jabatan"]').val(data.jenis_jabatan);
            $('[name="ikhitsar_jabatan"]').val(data.ikhitsar_jabatan);
            $('[name="jpt_utama"]').val(data.jpt_utama);
            $('[name="jpt_madya"]').val(data.jpt_madya);
            $('[name="pelaksana"]').val(data.pelaksana);
            $('[name="jabatan_fungsional"]').val(data.jabatan_fungsional);
            $('[name="urutan"]').val(data.urutan);
            $('[name="status"]').val(data.status);
            $('#modalReferensi').modal('show');
            $('.modal-title').text('Ubah Jabatan');

        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert("Gagal mendapatkan data Referensi");
        }
    });

}

function simpanRef() {
    var nama = $('[name="nama"]').val();
    var jenis_jabatan = $('#jenis_jabatan').val();

    if (!nama) {
        alert('Nama Jabatan harus diisi')
    }

    if (!jenis_jabatan) {
        alert('Jenis Jabatan harus diisi')
    }

    if (nama !== '' && jenis_jabatan !== '') {
        $('#btnSaveRef').text('Menyimpan...');
        $('#messageRef').html('');
        $('#btnSaveRef').attr('disabled', true);
        var url;
        var formData = new FormData($('#formRef')[0]);
        if (save_method == 'add') {
            url = "<?= base_url() . 'simanja/analisis_jabatan/p_add_ref' ?>";
        } else {
            url = "<?= base_url() . 'simanja/analisis_jabatan/p_update_ref' ?>";
        }

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function(data) {

                if (data.status) {
                    $('#modalReferensi').modal('hide');
                    swal("Berhasil", "Data Berhasil Disimpan!", "success");
                    location.reload();
                } else {
                    $('#messageRef').html('<div class="alert alert-danger">' + data.message + '</div>');
                }
                $('#btnSaveRef').text('Simpan');
                $('#btnSaveRef').attr('disabled', false);


            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error adding / update data');
                $('#btnSaveRef').text('Simpan');
                $('#btnSaveRef').attr('disabled', false);

            }
        });
    }
}

function deleteRef(id) {
    swal({
            title: "Hapus Data",
            text: "Apakah anda yakin akan menghapus data ini?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Ya',
            cancelButtonText: "Tidak",
            closeOnConfirm: false
        },
        function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: "<?= base_url() . 'simanja/analisis_jabatan/delete_ref/' ?>" + id,
                    type: "POST",
                    dataType: "JSON",
                    success: function(data) {
                        $('#modalReferensi').modal('hide');
                        swal("Berhasil", "Data Berhasil Dihapus!", "success");
                        location.reload();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error deleting data');
                    }
                });
            }
        });

}

function showImportExcel() {
    document.getElementById('import_excel').click();
}
</script>