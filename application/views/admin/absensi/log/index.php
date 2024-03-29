<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Data Log Absensi Pegawai</h4>
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
            <div class="white-box">
                <div class="row">
                    <form method="GET">
                        <div class="col-md-9">

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label class="control-label">SKPD</label>
                                    <select name="id_skpd" class="form-control select2">
                                        <?php
                                        if (isset($all_skpd)) {
                                            echo '<option value="">Semua SKPD</option>';
                                        }
                                        foreach ($skpd as $s) {
                                            $selected = (!empty($id_skpd) && $id_skpd == $s->id_skpd) ? ' selected' : '';
                                            echo '<option value="' . $s->id_skpd . '"' . $selected . '>' . $s->nama_skpd . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">

                                <div class="form-group">
                                    <label class="control-label"> Bulan</label>
                                    <select class="form-control select2" name="bulan" id="bulan">
                                        <?php
                                        for ($i = 1; $i <= 12; $i++) {
                                            $selected = (!empty($bulan) && $bulan == $i) ? "selected" : "";
                                            echo "<option $selected value='$i' >" . bulan($i) . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">


                                <div class="form-group">
                                    <label class="control-label"> Tahun</label>
                                    <select class="form-control select2" id="tahun" name="tahun">
                                        <?php
                                        for ($i = 2020; $i <= date("Y"); $i++) {
                                            $selected = (!empty($tahun) && $tahun == $i) ? "selected" : "";

                                            echo "<option $selected value='$i' >$i</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <br>
                                <button type="submit" value="1" name="filter" class="btn btn-primary m-t-5 btn-outline"><i class="ti-filter"></i>Filter</button>
                            </div>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <a href="<?= base_url('absensi/log/add?bulan='.$bulan.'&tahun='.$tahun) ?>" class="btn btn-primary"><span class="btn-label"><i class="fa fa-plus"></i></span> Tambah Log Absensi</a>
                <div class="table-responsive" style="margin-top: 15px;">
                    <table class="table table-stripped" id="tableLog">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIP</th>
                                <th>Nama</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th align="center">Aksi</th>
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



<div class="modal fade" id="modalLog" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myLargeModalLabel">Detail Log</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Pegawai</label>
                    <p class="text-purple"><span id="nip"></span> - <span id="nama_lengkap"></span></p>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <p><span id="id_ket_absen"></span> - <span id="ket_absen"></span></p>
                </div>
                <div class="form-group">
                    <label>Daftar Tanggal</label>
                    <div class="row">
                        <div class="col-lg-6 col-md-8 col-sm-12">
                            <table class="table table-striped table-bordered" id="tabelTanggalLog">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Tanggal</th>
                                        <!-- <th>Aksi</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Bukti</label>
                    <div id="forLampiranAda" style="display: none">
                        <a href="" id="btnLampiran" target="_blank" class="btn btn-primary"><i class="ti-download"></i> Download Lampiran</a>
                    </div>
                    <div id="forLampiranTidakAda" style="display: none">
                        Tidak ada
                    </div>
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

<script>
    $(document).ready(function() {

        $('#tableLog').DataTable({
            "pageLength": 10,
            "serverSide": true,
            "order": [
                [1, "asc"]
            ],
            "ajax": {
                url: base_url + 'absensi/log/listLog/<?= empty($id_skpd) ? 0 : $id_skpd ?>/<?= $bulan . "/" . $tahun ?>',
                type: 'POST'
            },
        }); // End of DataTable

    }); // End of DataTable
    function deleteLog(idKetLog) {

        swal({
                title: "Hapus Log",
                text: "Apakah anda yakin akan menghapus Log ini?",
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
                        url: "<?= base_url('absensi/log/deleteKetLog') ?>/" + idKetLog,
                        type: "POST",
                        dataType: "JSON",
                        success: function(data) {
                            swal("Berhasil", "Log Berhasil Dihapus!", "success");
                            location.reload(false);
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            alert('Error deleting data');
                        }
                    });
                }
            });
    }

    function detailLog(idKetLog) {
        $.getJSON("<?= base_url('absensi/log/getDetailLog') ?>/" + idKetLog, function(data) {
            $('#nip').html(data.nip);
            $('#nama_lengkap').html(data.nama_lengkap);
            $('#id_ket_absen').html(data.id_ket_absen);
            $('#ket_absen').html(data.ket_absen);
            if (data.bukti == '' || data.bukti == 'null' || data.bukti == null) {
                $('#forLampiranAda').hide();
                $('#forLampiranTidakAda').show();
            } else {
                $('#forLampiranTidakAda').hide();
                $('#forLampiranAda').show();
                $('#btnLampiran').attr('href', "<?= base_url('data/log_absen') ?>/" + data.id_pegawai + "/" + data.bukti);
            }
            var table = '';
            $.each(data.list_tanggal, function(index, value) {
                var no = index + 1;
                table += '<tr><td>'+no+'</td><td>'+value.tanggal_string+'</td></tr>'
            });
            $('#tabelTanggalLog > tbody').html(table);
            $('#modalLog').modal('show');
        });
    }
</script>