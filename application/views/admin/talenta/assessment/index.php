<div class="container-fluid">

    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Data Assesment Talenta</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <?php echo breadcrumb($this->uri->segment_array()); ?>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>



    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="white-box">

                <div class="table-responsive">
                    <table id="tblPegawai" class="table table-striped">
                        <thead>
                            <tr>
                                <th width="10px">No</th>
                                <th>NIP</th>
                                <th>Nama Lengkap</th>
                                <th>SKPD</th>
                                <th>Unit Kerja</th>
                                <th>Jabatan</th>
                                <th width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="modalMutasi">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Update Data Talent</h4>
            </div>
            <div class="modal-body">
                <form id="formTalenta">
                    <div class="form-group">
                        <label>Pegawai</label>
                        <p id="info_pegawai"></p>
                        <input type="hidden" name="id_pegawai">
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Rumpun</label>
                                <select name="rumpun" class="form-control select2">
                                    <option value="">Pilih Rumpun</option>
                                    <?php
                                    foreach ($rumpun as $row) {
                                        echo "<option value=\"$row\">$row</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Pendidikan</label>
                                <select name="pendidikan" class="form-control select2">
                                    <option value="">Pilih Pendidikan</option>
                                    <?php
                                    foreach ($pendidikan as $row) {
                                        echo "<option value=\"$row\">$row</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Pangkat</label>
                                <select name="pangkat" class="form-control select2">
                                    <option value="">Pilih Pangkat</option>
                                    <?php
                                    foreach ($pangkat as $row) {
                                        echo "<option value=\"$row\">$row</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Golongan</label>
                                <select name="golongan" class="form-control select2">
                                    <option value="">Pilih Golongan</option>
                                    <?php
                                    foreach ($golongan as $row) {
                                        echo "<option value=\"$row\">$row</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Eselon</label>
                                <select name="eselon" class="form-control select2">
                                    <option value="">Pilih Eselon</option>
                                    <?php
                                    foreach ($eselon as $row) {
                                        echo "<option value=\"$row\">$row</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Hasil Asesmen</label>
                                <select name="hasil_asesmen" class="form-control select2">
                                    <option value="">Pilih Hasil Asesmen</option>
                                    <?php
                                    foreach ($hasil_asesmen as $row) {
                                        echo "<option value=\"$row\">" . normal_string($row) . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Diklat PIM</label>
                                <select name="diklat_pim" class="form-control select2">
                                    <option value="">Pilih Diklat PIM</option>
                                    <?php
                                    foreach ($diklat_pim as $row) {
                                        echo "<option value=\"$row\">Diklat PIM Tk. $row</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nilai PPKPNS</label>
                                <input type="text" name="nilai_ppkpns" class="form-control" placeholder="Masukkan Nilai PPKPNS">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Hukuman Disiplin</label>
                                <div class="radio-list">
                                    <label class="radio-inline p-0">
                                        <div class="radio radio-primary">
                                            <input type="radio" name="hukuman_disiplin" id="hdya" value="ya">
                                            <label for="hdya">Ya</label>
                                        </div>
                                    </label>
                                    <label class="radio-inline">
                                        <div class="radio radio-primary">
                                            <input type="radio" name="hukuman_disiplin" id="hdtdk" value="tidak">
                                            <label for="hdtdk">Tidak</label>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Masa Kerja</label>
                                <select name="masa_kerja" class="form-control select2">
                                    <option value="">Pilih Masa Kerja</option>
                                    <?php
                                    foreach ($masa_kerja as $key => $row) {
                                        echo "<option value=\"$key\">$row</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSavePegawai" onclick="saveMutasi()" class="btn btn-primary"><span class="btn-label"><i class="fa fa-floppy-o"></i></span>Simpan</button>
                <button type="button" id="btnSavePegawai" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        $('#tblPegawai').DataTable({
            "pageLength": 10,
            "serverSide": true,
            "order": [
                [1, "asc"]
            ],
            "ajax": {
                url: base_url + 'talenta/assessment/list_pegawai',
                type: 'POST'
            },
        }); // End of DataTable

    }); // End of DataTable

    function mutasi(id_pegawai) {
        $('#message').html('');
        $('#formTalenta').find('input:text').val('');
        $('#formTalenta').find('input:radio').prop('checked', false)
        $('#formTalenta').find('textarea').text('');
        $('#formTalenta').find('textarea').val('');
        $('#formTalenta').find('select').val('');
        $('#formTalenta').find('select').trigger('change');
        $.getJSON("<?= base_url(); ?>talenta/assessment/fetch_pegawai/" + id_pegawai, function(data) {
            $('#info_pegawai').html(data.nip + ' - ' + data.nama_lengkap);
            $.each(data, function(i, item) {
                if (i !== 'hukuman_disiplin') {
                    $('[name="' + i + '"]').val(item);
                }
            });

            $('[name="hukuman_disiplin"][value="' + data.hukuman_disiplin + '"]').prop("checked", true);
            $('#formTalenta').find('select').trigger('change');
            $('#modalMutasi').modal('show');
        });
    }

    function saveMutasi() {
        $('#btnSavePegawai').html('<span class="btn-label"><i class="fa fa-circle-o-notch fa-spin"></i></span>Memproses');
        $.post("<?= base_url('talenta/assessment/update_data') ?>", $("#formTalenta").serialize(), function(data) {
            if (data.result) {
                $('#tblPegawai').DataTable().ajax.reload();
                swal("Sukses", "Data Pegawai berhasil disimpan", "success");
                $('#modalMutasi').modal('hide');
            } else {
                $('#message').html('<div class="alert alert-warning">' + data.message + '</div>')
            }
            $('#btnSavePegawai').html('<span class="btn-label"><i class="fa fa-floppy-o"></i></span>Simpan');
        }, "json");
    }
</script>