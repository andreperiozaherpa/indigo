<div class="container-fluid">

    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Detail Analisis Beban Kerja</h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

            <ol class="breadcrumb">
                <li><a href="<?= base_url(); ?>admin">Dashboard</a></li>
                <li><a href="<?= base_url('simanja/analisis_jabatan'); ?>">Analisis Beban Kerja</a></li>
                <li class="active"><?=$detail->nama?></li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
    <!-- .row -->
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-default" style="border-top: 10px solid #6003c8">
                        <div class="panel-heading">
                            <div class="panel-wrapper collapse in">
                                <div class="panel-body">
                                    <table id="w1" class="table table-striped">
                                        <tr>
                                            <th width="180px" style="text-align:right">Nama Jabatan</th>
                                            <td><?=$detail->nama ?: '-'?></td>
                                        </tr>
                                        <tr>
                                            <th width="180px" style="text-align:right">Jenis Jabatan</th>
                                            <td><?=$detail->jenis_jabatan ?: '-' ?></td>
                                        </tr>
                                        <tr>
                                            <th width="180px" style="text-align:right">Ikhtisar Jabatan</th>
                                            <td><?=$detail->ikhtisar_jabatan ?: '-'?></td>
                                        </tr>
                                        <tr>
                                            <th width="180px" style="text-align:right">Jumlah Pemangku Saat Ini</th>
                                            <td><?=($detail->jumlah_pemangku != null) ? $detail->jumlah_pemangku : 'Belum diisi'?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th width="180px" style="text-align:right">Jumlah Pemangku Berdasarkan Hasil
                                                ABK</th>
                                            <td id="hasil_abk">-</td>
                                        </tr>
                                        <tr>
                                            <th width="180px" style="text-align:right">Kelebihan / Kekurangan</th>
                                            <td id="kelebihan_kekurangan">-</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <button type="button" class="btn waves-effect waves-light btn-info dropdown-toggle"
                                data-toggle="dropdown"><i class="fa fa-list"></i> Pilihan Menu <span
                                    class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li><a href="javascript:void(0)" onclick="editRef(<?=$detail->id?>)"><i
                                            class="fa fa-edit"></i><small> Sunting Jabatan</small> </a></li>
                                <li><a href="javascript:void(0)" onclick="deleteRef(<?=$detail->id?>)"><i
                                            class="fa fa-trash"></i><small> Hapus Jabatan</small></a></li>
                                <?php if($sender && $this->session->userdata('level') == 'Administrator' || in_array('admin_simanja', $user_privileges)){ ?>
                                <!-- <li class="divider"></li>
                                <li><a href="<?=base_url('simanja/analisis_beban_kerja/export_pdf/'.$detail->id)?>"><i
                                            class="fa fa-file-excel-o"></i> <small>CETAK ABK EXCEL</small></a></li> -->
                                <?php } ?>
                                <?php if($sender->status == 3){ ?>
                                <li class="divider"></li>
                                <li><a href="<?=base_url('simanja/analisis_beban_kerja/export_pdf_ver1f/'.$detail->id)?>"><i
                                            class="fa fa-file-pdf-o"></i> <small>CETAK ABK</small></a></li>
                                <?php }else{ ?>
                                <li><a href="<?=base_url('simanja/analisis_beban_kerja/export_pdf/'.$detail->id)?>"><i
                                            class="fa fa-file-pdf-o"></i> <small>CETAK ABK</small></a></li>
                                <?php } ?>
                            </ul>
                            <?php if($hasil_kerja){ ?>
                            <a href="<?=base_url('simanja/analisis_jabatan/detail/'.$detail->id)?>"
                                class="btn btn-primary"><i class="fa fa-user"></i> Analisis Jabatan</a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="white-box">
                    <h2>Uraian Tugas</h2>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Uraian Tugas</th>
                                    <th>Jumlah Hasil</th>
                                    <th>Satuan Hasil</th>
                                    <th>Waktu Penyelesaian (JAM)</th>
                                    <th>Waktu Kerja Efektif</th>
                                    <th>Beban Kerja</th>
                                    <th>Pegawai Yang Dibutuhkan</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                      $no = 1;
                      $jumlah_beban_kerja = 0;
                      $jumlah_kebutuhan_pegawai = 0;
                      foreach($hasil_kerja as $i) {
                        $jumlah_hasil = $i->jumlah_hasil ?: 0;
			                  $waktu_penyelesaian = $i->waktu_penyelesaian ?: 0;
                        $beban_kerja = $jumlah_hasil * $waktu_penyelesaian;
                        $kebutuhan_pegawai = $jumlah_hasil * str_replace(',','.',$waktu_penyelesaian) / 1250;
                        $jumlah_beban_kerja += $beban_kerja;
                        $jumlah_kebutuhan_pegawai += $kebutuhan_pegawai;
                        ?>
                                <tr>
                                    <td><?=$no++?></td>
                                    <td><?=$i->uraianTugas?></td>
                                    <td><?=$i->jumlah_hasil?></td>
                                    <td><?=$i->satuan_hasil?></td>
                                    <td><?=$i->waktu_penyelesaian?></td>
                                    <td>1250</td>
                                    <td><?=$beban_kerja?></td>
                                    <td><?=$kebutuhan_pegawai?></td>
                                    <td style="width:150px">
                                        <a href="javascript:void(0)" onclick="editHasilKerja(<?=$i->id?>)"
                                            class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></a>
                                    </td>
                                </tr>
                                <?php } ?>
                                <tr>
                                    <td colspan="6" style="text-align: right;font-weight: bold">Jumlah</td>
                                    <td><?=$jumlah_beban_kerja?></td>
                                    <td><?=$jumlah_kebutuhan_pegawai?></td>
                                </tr>
                                <tr>
                                    <td colspan="6" style="text-align: right;font-weight: bold">Pembulatan</td>
                                    <td></td>
                                    <td id="jumlah_kebutuhan_pegawai"><?=round($jumlah_kebutuhan_pegawai)?></td>
                                </tr>
                                <?php echo $hasil_kerja ? null : '<tr><td colspan="3">Belum ada data</td></tr>' ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- .row -->

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
                                    <label for="message-text" class="control-label">Jumlah Pemangku</label>
                                    <input type="number" name="jumlah_pemangku" class="form-control"
                                        placeholder="Masukkan Jumlah Pemangku Jabatan">
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" onclick="simpanRef()" id="btnSaveRef"
                                class="btn btn-primary">Simpan</button>
                        </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
            </div>

            <div id="modalHasilKerja" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="exampleModalLabel1">Ubah</h4>
                        </div>
                        <div class="modal-body">
                            <form id="formHasilKerja">
                                <div id="hiddenHasilKerja"></div>
                                <div id="messageHasilKerja"></div>
                                <input type="hidden" name="id_analisis_jabatan" value="<?=$detail->id?>">
                                <div class="form-group">
                                    <label for="message-text" class="control-label">Uraian Tugas <sup
                                            class="text-danger" title="wajib diisi">*</sup> </label>
                                    <select class="form-control" name="id_tugas_pokok">
                                        <?php foreach($tugas_pokok as $i) { ?>
                                        <option value="<?=$i->id?>"><?=$i->uraian_tugas?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="control-label">Hasil Kerja <sup class="text-danger"
                                            title="wajib diisi">*</sup> </label>
                                    <textarea class="form-control" name="hasil_kerja"></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Jumlah Hasil</label>
                                    <input class="form-control" name="jumlah_hasil" type="number">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Waktu Penyelesaian (dalam JAM)</label>
                                    <input class="form-control" name="waktu_penyelesaian" type="text">
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="control-label">Satuan Hasil <sup
                                            class="text-danger" title="wajib diisi">*</sup> </label>
                                    <select class="form-control" name="id_satuan_hasil">
                                        <?php foreach($satuan_hasil as $i) { ?>
                                        <option value="<?=$i->id?>"><?=$i->nama?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" onclick="simpanHasilKerja()" id="btnSaveHasilKerja"
                                class="btn btn-primary">Simpan</button>
                        </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
            </div>

        </div>

        <script>
        //DETAIL 
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
                    $('[name="id_ref"]').val(data.id);
                    $('[name="jumlah_pemangku"]').val(data.jumlah_pemangku);
                    $('#modalReferensi').modal('show');
                    $('.modal-title').text('Ubah Jabatan');

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert("Gagal mendapatkan data");
                }
            });

        }

        function simpanRef() {
            var jumlah_pemangku = $('[name="jumlah_pemangku"]').val();

            if (!jumlah_pemangku) {
                alert('jumlah_pemangku Jabatan harus diisi')
            }

            if (jumlah_pemangku !== '') {
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
                            $('#messageRef').html('<div class="alert alert-danger">' + data.message +
                                '</div>');
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
                                window.location.href = "<?=base_url('simanja/analisis_jabatan')?>";
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                alert('Error deleting data');
                            }
                        });
                    }
                });

        }

        //Kualifikasi Jabatan
        function addKualifikasiJabatan() {
            save_method = 'add';
            $('#formKualifikasiJabatan')[0].reset();
            $('#messageKualifikasiJabatan').html('');
            $('#modalKualifikasiJabatan').modal('show');
            $('.modal-title').text('Tambah');
        }

        function editKualifikasiJabatan(id) {
            save_method = 'update';
            $('#formKualifikasiJabatan')[0].reset();
            $('#messageKualifikasiJabatan').html('');
            $('.form-group').removeClass('has-error');
            $('#hiddenKualifikasiJabatan').html('<input type="hidden" value="" name="id_kualifikasi_jabatan"/>');
            $('.help-block').empty();
            $.ajax({
                url: "<?= base_url() . 'simanja/analisis_jabatan/fetch_kualifikasi_jabatan/' ?>" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('[name="id_kualifikasi_jabatan"]').val(data.id);
                    $('[name="pendidikan_formal"]').val(data.pendidikan_formal);
                    $('[name="diklat_perjejangan"]').val(data.diklat_perjejangan);
                    $('[name="diklat_teknis"]').val(data.diklat_teknis);
                    $('[name="pengalaman_kerja"]').val(data.pengalaman_kerja);
                    $('#modalKualifikasiJabatan').modal('show');
                    $('.modal-title').text('Ubah');

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert("Gagal mendapatkan data");
                }
            });
        }

        function simpanKualifikasiJabatan() {
            var pendidikan_formal = $('[name="pendidikan_formal"]').val();
            var diklat_perjejangan = $('[name="diklat_perjejangan"]').val();
            var diklat_teknis = $('[name="diklat_teknis"]').val();
            var pengalaman_kerja = $('[name="pengalaman_kerja"]').val();

            if (pendidikan_formal === null) {
                alert('Pendidikan Formal harus diisi')
            }
            if (diklat_perjejangan === null) {
                alert('Diklat Perjejangan harus diisi')
            }
            if (diklat_teknis === null) {
                alert('Diklat Teknis harus diisi')
            }
            if (pengalaman_kerja === null) {
                alert('Pengalaman Kerja harus diisi')
            }

            if (pendidikan_formal !== null && diklat_perjejangan !== null & diklat_teknis !== null &&
                pengalaman_kerja !== null) {
                $('#btnSaveKualifikasiJabatan').text('Menyimpan...');
                $('#messageKualifikasiJabatan').html('');
                $('#btnSaveKualifikasiJabatan').attr('disabled', true);
                var url;
                var formData = new FormData($('#formKualifikasiJabatan')[0]);
                if (save_method == 'add') {
                    url = "<?= base_url() . 'simanja/analisis_jabatan/p_add_kualifikasi_jabatan' ?>";
                } else {
                    url = "<?= base_url() . 'simanja/analisis_jabatan/p_update_kualifikasi_jabatan' ?>";
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
                            $('#modalKualifikasiJabatan').modal('hide');
                            swal("Berhasil", "Data Berhasil Disimpan!", "success");
                            location.reload();
                        } else {
                            $('#messageKualifikasiJabatan').html('<div class="alert alert-danger">' + data
                                .message + '</div>');
                        }
                        $('#btnSaveKualifikasiJabatan').text('Simpan');
                        $('#btnSaveKualifikasiJabatan').attr('disabled', false);


                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error adding / update data');
                        $('#btnSaveKualifikasiJabatan').text('Simpan');
                        $('#btnSaveKualifikasiJabatan').attr('disabled', false);

                    }
                });
            }
        }

        function deleteKualifikasiJabatan(id) {
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
                            url: "<?= base_url() . 'simanja/analisis_jabatan/delete_kualifikasi_jabatan/' ?>" +
                                id,
                            type: "POST",
                            dataType: "JSON",
                            success: function(data) {
                                $('#modalKualifikasiJabatan').modal('hide');
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

        //Tugas Pokok
        function addTugasPokok() {
            save_method = 'add';
            $('#formTugasPokok')[0].reset();
            $('#messageTugasPokok').html('');
            $('#modalTugasPokok').modal('show');
            $('.modal-title').text('Tambah');
        }

        function editTugasPokok(id) {
            save_method = 'update';
            $('#formTugasPokok')[0].reset();
            $('#messageTugasPokok').html('');
            $('.form-group').removeClass('has-error');
            $('#hiddenTugasPokok').html('<input type="hidden" value="" name="id_tugas_pokok"/>');
            $('.help-block').empty();
            $.ajax({
                url: "<?= base_url() . 'simanja/analisis_jabatan/fetch_tugas_pokok/' ?>" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('[name="id_tugas_pokok"]').val(data.id);
                    $('[name="uraian_tugas"]').val(data.uraian_tugas);
                    $('#modalTugasPokok').modal('show');
                    $('.modal-title').text('Ubah');

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert("Gagal mendapatkan data");
                }
            });

        }

        function simpanTugasPokok() {
            var uraian_tugas = $('[name="uraian_tugas"]').val();

            if (!uraian_tugas) {
                alert('Uraian Tugas Jabatan harus diisi')
            }

            if (uraian_tugas !== '') {
                $('#btnSaveTugasPokok').text('Menyimpan...');
                $('#messageTugasPokok').html('');
                $('#btnSaveTugasPokok').attr('disabled', true);
                var url;
                var formData = new FormData($('#formTugasPokok')[0]);
                if (save_method == 'add') {
                    url = "<?= base_url() . 'simanja/analisis_jabatan/p_add_tugas_pokok' ?>";
                } else {
                    url = "<?= base_url() . 'simanja/analisis_jabatan/p_update_tugas_pokok' ?>";
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
                            $('#modalTugasPokok').modal('hide');
                            swal("Berhasil", "Data Berhasil Disimpan!", "success");
                            location.reload();
                        } else {
                            $('#messageTugasPokok').html('<div class="alert alert-danger">' + data.message +
                                '</div>');
                        }
                        $('#btnSaveTugasPokok').text('Simpan');
                        $('#btnSaveTugasPokok').attr('disabled', false);


                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error adding / update data');
                        $('#btnSaveTugasPokok').text('Simpan');
                        $('#btnSaveTugasPokok').attr('disabled', false);

                    }
                });
            }
        }

        function deleteTugasPokok(id) {
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
                            url: "<?= base_url() . 'simanja/analisis_jabatan/delete_tugas_pokok/' ?>" + id,
                            type: "POST",
                            dataType: "JSON",
                            success: function(data) {
                                $('#modalTugasPokok').modal('hide');
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

        //Hasil Kerja

        function editHasilKerja(id) {
            save_method = 'update';
            $('#formHasilKerja')[0].reset();
            $('#messageHasilKerja').html('');
            $('.form-group').removeClass('has-error');
            $('#hiddenHasilKerja').html('<input type="hidden" value="" name="id_hasil_kerja"/>');
            $('.help-block').empty();
            $.ajax({
                url: "<?= base_url() . 'simanja/analisis_jabatan/fetch_hasil_kerja/' ?>" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('[name="id_hasil_kerja"]').val(data.id);
                    $('[name="id_uraian_tugas"]').val(data.id_uraian_tugas);
                    $('[name="hasil_kerja"]').val(data.hasil_kerja);
                    $('[name="jumlah_hasil"]').val(data.jumlah_hasil);
                    $('[name="waktu_penyelesaian"]').val(data.waktu_penyelesaian);
                    $('[name="id_satuan_hasil"]').val(data.id_satuan_hasil);
                    $('#modalHasilKerja').modal('show');
                    $('.modal-title').text('Ubah');

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert("Gagal mendapatkan data");
                }
            });

        }

        function simpanHasilKerja() {
            var hasil_kerja = $('[name="hasil_kerja"]').val();
            var jumlah_hasil = $('[name="jumlah_hasil"]').val();
            var waktu_penyelesaian = $('[name="waktu_penyelesaian"]').val();

            if (!hasil_kerja) {
                alert('Hasil Kerja harus diisi')
            }

            if (!jumlah_hasil) {
                alert('Jumlah hasil harus diisi')
            }

            if (!waktu_penyelesaian) {
                alert('Waktu penyelesaian harus diisi')
            }

            if (hasil_kerja !== '' || jumlah_hasil !== '' || waktu_penyelesaian !== '') {
                $('#btnSaveHasilKerja').text('Menyimpan...');
                $('#messageHasilKerja').html('');
                $('#btnSaveHasilKerja').attr('disabled', true);
                var url;
                var formData = new FormData($('#formHasilKerja')[0]);
                if (save_method == 'add') {
                    url = "<?= base_url() . 'simanja/analisis_jabatan/p_add_hasil_kerja' ?>";
                } else {
                    url = "<?= base_url() . 'simanja/analisis_jabatan/p_update_hasil_kerja' ?>";
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
                            $('#modalHasilKerja').modal('hide');
                            swal("Berhasil", "Data Berhasil Disimpan!", "success");
                            location.reload();
                        } else {
                            $('#messageHasilKerja').html('<div class="alert alert-danger">' + data.message +
                                '</div>');
                        }
                        $('#btnSaveHasilKerja').text('Simpan');
                        $('#btnSaveHasilKerja').attr('disabled', false);


                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error adding / update data');
                        $('#btnSaveHasilKerja').text('Simpan');
                        $('#btnSaveHasilKerja').attr('disabled', false);

                    }
                });
            } else {
                alert('Isi semua form !')
            }
        }

        let jumlah_pemangku = '<?=$detail->jumlah_pemangku?>';
        let kebutuhan_pegawai = $('#jumlah_kebutuhan_pegawai').text();
        let kelebihan_kekurangan = jumlah_pemangku - kebutuhan_pegawai;
        $('#hasil_abk').html(kebutuhan_pegawai);
        $('#kelebihan_kekurangan').html(kelebihan_kekurangan);
        </script>