<style>
    th,
    td {
        vertical-align: middle !important;
    }

    td {
        background-color: #fff !important;
    }
</style>
<div class="container-fluid">

    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Visi, Misi, dan Tujuan Desa</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li>Visi Misi Desa</li>
                <li class="active">Detail</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Visi <span class="label label-primary pull-right m-l-5"> <button type="button" onclick="addVisi()" class="btn btn-primary btn-sm">Edit Visi </button></span></div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <p><?= $visi ? $visi->visi : '<i>Belum diisi</i>' ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Misi</div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">

                                <table class="table color-table dark-table table-hover">

                                    <thead>
                                        <tr>
                                            <th>#</th>

                                            <th>Misi </th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($misi as $k => $m) {
                                            $n = $k+1;
                                             ?>
                                            <tr>
                                                <td><?= $n ?></td>
                                                <td><?= $m->misi ?>
                                                </td>

                                                <td style="width:150px">
                                                    <a href="javascript:void(0)" onclick="editMisi(<?= $m->id_sd_misi ?>)" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i> Edit</a> <a href="javascript:void(0)" onclick="deleteMisi(<?= $m->id_sd_misi ?>)" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</a>
                                                </td>
                                            </tr>
                                        <?php } ?>


                                    </tbody>



                                </table>

                                <button type="button" class="btn btn-danger e" onclick="addMisi()"><i class="fa fa-plus"></i> Tambah Misi</button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Tujuan</div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">

                                <table class="table color-table dark-table table-hover">

                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Ref.Misi </th>
                                            <th>Tujuan </th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($tujuan as $k => $t) {
                                            $n = $k++; ?>
                                            <tr>
                                                <td><?= $n ?></td>
                                                <td><?= $t->misi ?></td>
                                                <td><?= $t->tujuan ?></td>
                                                <td style="width:150px">
                                                    <a href="javascript:void(0)" onclick="editTujuan(<?= $t->id_sd_tujuan ?>)" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i> Edit</a> <a href="javascript:void(0)" onclick="deleteTujuan(<?= $t->id_sd_tujuan ?>)" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</a>
                                                </td>
                                            </tr>
                                        <?php } ?>

                                    </tbody>
                                </table>
                                <button type="button" class="btn btn-danger e" onclick="addTujuan()"><i class="fa fa-plus"></i> Tambah Tujuan</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


        </div>
        <!-- .row -->

    </div>



    <div id="modalVisi" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel1">Ubah Visi</h4>
                </div>
                <div class="modal-body">
                    <form id="formVisi">
                        <input type="hidden" name="id_sd_visi">
                        <div class="form-group">
                            <label for="message-text" class="control-label">Visi</label>
                            <textarea name="visi" class="form-control" placeholder="Masukkan Visi"></textarea>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" onclick="simpanVisi()" id="btnSave" class="btn btn-primary">Simpan</button>
                </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <script type="text/javascript">
        function addVisi() {
            $('#formVisi')[0].reset();
            $('#message').html('');
            $.ajax({
                url: "<?= base_url() ?>/visimisi_desa/getVisi/<?= $id_skpd ?>",
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    if (data) {
                        $('[name="id_sd_visi"]').val(data.id_sd_visi);
                        $('[name="visi"]').val(data.visi);
                    }
                    $('#modalVisi').modal('show');
                    $('.modal-title').text('Ubah Visi');

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert("Gagal mendapatkan data");
                }
            });
        }

        function simpanVisi() {
            $('#btnSave').text('Menyimpan...');
            $('#message').html('');
            $('#btnSave').attr('disabled', true);
            var url;
            var formData = new FormData($('#formVisi')[0]);
            $.ajax({
                url: "<?= base_url() ?>/visimisi_desa/updateVisi/<?= $id_skpd ?>",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function(data) {
                    $('#modalVisi').modal('hide');
                    swal("Berhasil", "Data Berhasil Disimpan!", "success");
                    location.reload();
                    $('#btnSave').text('Simpan');
                    $('#btnSave').attr('disabled', false);

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error adding / update data');
                    $('#btnSave').text('Simpan');
                    $('#btnSave').attr('disabled', false);

                }
            });
        }
    </script>

    <div id="modalMisi" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel1">Ubah Misi</h4>
                </div>
                <div class="modal-body">
                    <form id="formMisi">
                        <div id="hidden"></div>
                        <div id="message"></div>
                        <div class="form-group">
                            <label for="message-text" class="control-label">Misi</label>
                            <textarea name="misi" class="form-control" placeholder="Masukkan Misi"></textarea>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" onclick="simpanMisi()" id="btnSave" class="btn btn-primary">Simpan</button>
                </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <script type="text/javascript">
        var save_method;

        function addMisi() {
            save_method = 'add';
            $('#formMisi')[0].reset();
            $('#message').html('');
            $('#modalMisi').modal('show');
            $('.modal-title').text('Tambah Misi');
        }

        function editMisi(id) {
            save_method = 'update';
            $('#formMisi')[0].reset();
            $('#message').html('');
            $('.form-group').removeClass('has-error');
            $('#hidden').html('<input type="hidden" value="" name="id_sd_misi"/>');
            $('.help-block').empty();
            $.ajax({
                url: "<?= base_url() ?>/visimisi_desa/fetchMisi/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('[name="id_sd_misi"]').val(data.id_sd_misi);
                    $('[name="misi"]').text(data.misi);
                    $('#modalMisi').modal('show');
                    $('.modal-title').text('Ubah Misi');

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert("Gagal mendapatkan data");
                }
            });

        }

        function simpanMisi() {
            $('#btnSave').text('Menyimpan...');
            $('#message').html('');
            $('#btnSave').attr('disabled', true);
            var url;
            var formData = new FormData($('#formMisi')[0]);
            console.log(formData);
            if (save_method == 'add') {
                url = "<?= base_url() ?>/visimisi_desa/insertMisi/<?=$id_skpd?>";
            } else {
                url = "<?= base_url() ?>/visimisi_desa/updateMisi";
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
                        $('#modalMisi').modal('hide');
                        swal("Berhasil", "Data Berhasil Disimpan!", "success");
                        location.reload();
                    } else {
                        $('#message').html('<div class="alert alert-danger">' + data.message + '</div>');
                    }
                    $('#btnSave').text('Simpan');
                    $('#btnSave').attr('disabled', false);


                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error adding / update dataeeS');
                    $('#btnSave').text('Simpan');
                    $('#btnSave').attr('disabled', false);

                }
            });
        }

        function deleteMisi(id) {
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
                            url: "<?= base_url() ?>/visimisi_desa/deleteMisi/" + id,
                            type: "POST",
                            dataType: "JSON",
                            success: function(data) {
                                $('#modalMisi').modal('hide');
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
    </script>

    <div id="modalTujuan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel1">Ubah Tujuan</h4>
                </div>
                <div class="modal-body">
                    <form id="formTujuan">
                        <div id="hidden"></div>
                        <div id="message"></div>
                        <div class="form-group">
                            <label for="message-text" class="control-label">Misi</label>
                            <select class="form-control" name="id_misi">
                                <option value="">Pilih Misi</option>
                                <option value="1">Memenuhi kebutuhan dasar secara mudah dan terjangkau
                                </option>
                                <option value="2">Menguatkan norma agama dalam tatanan kehidupan sosial masyarakat dan pemerintahan</option>
                                <option value="3">Mengembangkan wilayah ekonomi didukung dengan peningkatan infrastruktur, serta penguatan budaya dan kearifan lokal</option>
                                <option value="5">Menata birokrasi pemerintah yang responsif dan bertanggung jawab secara profesional dalam pelayanan masyarakat</option>
                                <option value="6">Mengembangkan sarana prasarana dan sistem perekonomian yang mendukung kreativitas dan inovasi masyarakat Kabupaten Sumedang</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="control-label">Tujuan</label>
                            <textarea name="tujuan" class="form-control" placeholder="Masukkan Tujuan"></textarea>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" onclick="simpanTujuan()" id="btnSave" class="btn btn-primary">Simpan</button>
                </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <script type="text/javascript">
        var save_method;

        function addTujuan() {
            save_method = 'add';
            $('#formTujuan')[0].reset();
            $('#message').html('');
            $('#modalTujuan').modal('show');
            $('.modal-title').text('Tambah Tujuan');
        }

        function editTujuan(id) {
            save_method = 'update';
            $('#formTujuan')[0].reset();
            $('#message').html('');
            $('.form-group').removeClass('has-error');
            $('#formTujuan #hidden').html('<input type="hidden" value="" name="id_tujuan"/>');
            $('.help-block').empty();
            $.ajax({
                url: "#url/ref_visi_misi/fetch_Tujuan/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('[name="id_tujuan"]').val(data.id_tujuan);
                    $('[name="tujuan"]').val(data.tujuan);
                    $('[name="id_misi"]').val(data.id_misi);
                    $('#modalTujuan').modal('show');
                    $('.modal-title').text('Ubah Tujuan');

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert("Gagal mendapatkan data");
                }
            });

        }

        function simpanTujuan() {
            $('#btnSave').text('Menyimpan...');
            $('#message').html('');
            $('#btnSave').attr('disabled', true);
            var url;
            var formData = new FormData($('#formTujuan')[0]);
            if (save_method == 'add') {
                url = "#url/ref_visi_misi/p_add_t";
            } else {
                url = "#url/ref_visi_misi/p_update_t";
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
                        $('#modalTujuan').modal('hide');
                        swal("Berhasil", "Data Berhasil Disimpan!", "success");
                        location.reload();
                    } else {
                        $('#message').html('<div class="alert alert-danger">' + data.message + '</div>');
                    }
                    $('#btnSave').text('Simpan');
                    $('#btnSave').attr('disabled', false);


                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error adding / update data');
                    $('#btnSave').text('Simpan');
                    $('#btnSave').attr('disabled', false);

                }
            });
        }

        function deleteTujuan(id) {
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
                            url: "#url/ref_visi_misi/delete_t/" + id,
                            type: "POST",
                            dataType: "JSON",
                            success: function(data) {
                                $('#modalTujuan').modal('hide');
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
    </script>
</div>