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
                <h3 class="box-title" style="margin-bottom: 0px;padding-bottom:0px">Tambah Log Absensi Pegawai</h3>
                <span style="margin-bottom: 20px;" class="text-muted">Bulan <span style="font-weight:500"><?=bulan($bulan)?> </span> Tahun <span style="font-weight:500"><?=$tahun?></span><hr>
                <?php
                if (isset($message)) { ?>
                    <div class="alert alert-<?= $message_type ?>"><?= $message ?></div>
                <?php
                }
                ?>
                <?= form_open_multipart() ?>
                <div class="form-group">
                    <label>Pegawai</label>
                    <input type="text" class="form-control" placeholder="Pilih Pegawai" name="id_pegawai" required>
                </div>
                <div class="form-group">
                    <label>Alasan Tidak Hadir</label>
                    <select name="id_ket_absen" onchange="cekAlasan()" class="form-control select2" required>
                        <option value="">Pilih Alasan Tidak Hadir</option>
                        <?php
                        foreach ($alasan as $s) {
                            echo '<option value="' . $s->id_ket_absen . '">' . $s->ket_absen . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group" id="divPeriode">
                    <label>Periode Absensi</label>
                    <div class="input-group">
                        <input type="text" name="tanggal_awal" onchange="initTglAkhir()" class="form-control dateLogAwal" autocomplete="off" id="" placeholder="Pilih Tanggal Awal">
                        <span class="input-group-addon">s.d</span>
                        <input type="text" name="tanggal_akhir" class="form-control dateLogAkhir" autocomplete="off" id="" placeholder="Pilih Tanggal Akhir">
                    </div>
                </div>
                <div class="form-group" id="divTerhitung" style="display: none;">
                    <label>Terhitung mulai Tanggal</label>
                    <input type="text" name="tanggal_awal" class="form-control" autocomplete="off" id="datepicker" placeholder="Pilih Tanggal Awal">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea class="form-control" name="keterangan" placeholder="Masukkan Keterangan" rows="9"></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>File Bukti</label>
                            <input type="file" name="bukti" class="dropify">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="m-l-10 btn btn-primary pull-right"><span class="btn-label"><i class="ti-save"></i></span> Simpan</button>
                            <a href="<?= base_url('absensi/log') ?>" class="btn btn-outline btn-primary pull-right"><span class="btn-label"><i class="ti-back-left"></i></span> Kembali</a>
                        </div>
                    </div>
                </div>
                </form>

            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        $('#divTerhitung').hide();
        $('#divPeriode').hide();

        $('[name="id_pegawai"]').select2({
            minimumInputLength: 2,
            allowClear: true,
            placeholder: 'Pilih Pegawai',
            ajax: {
                dataType: 'json',
                url: '<?= base_url('absensi/log/get_pegawai/'.$bulan.'/'.$tahun) ?>',
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
        jQuery('.dateLogAwal').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true
        });
    });


    function initTglAkhir() {
        $('.dateLogAkhir').val('');
        var tgl_awal = $('.dateLogAwal').val();
        // alert(tgl_awal);
        var date = new Date(tgl_awal);
        // alert(date);
        var startDate = new Date(date.getFullYear(), date.getMonth(), 1);
        // alert(startDate);
        var endDate = new Date(date.getFullYear(), date.getMonth() + 1, 0);
        $('.dateLogAkhir').datepicker('remove');
        $('.dateLogAkhir').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true,
            startDate: startDate,
            endDate: endDate
        });
    }

    function cekAlasan() {
        var id_ket_absen = $('[name="id_ket_absen"]').val();
        if (id_ket_absen !== '') {
            $.getJSON("<?= base_url('absensi/log/cekAlasan') ?>/" + id_ket_absen, function(data) {
                if (data.satuan == 'bulan') {
                    $('#divTerhitung').show();
                    $('#divPeriode').hide();
                    $('#divPeriode [name="tanggal_awal"]').attr('disabled', 'disabled');
                    $('#divPeriode [name="tanggal_akhir"]').attr('disabled', 'disabled');
                    $('#divTerhitung [name="tanggal_awal"]').removeAttr('disabled');

                    $('#divPeriode [name="tanggal_awal"]').removeAttr('required');
                    $('#divPeriode [name="tanggal_akhir"]').removeAttr('required');
                    $('#divTerhitung [name="tanggal_awal"]').attr('required', 'required');

                } else {
                    $('#divTerhitung').hide();
                    $('#divPeriode').show();
                    $('#divPeriode [name="tanggal_awal"]').removeAttr('disabled');
                    $('#divPeriode [name="tanggal_akhir"]').removeAttr('disabled');
                    $('#divTerhitung [name="tanggal_awal"]').attr('disabled', 'disabled');


                    $('#divPeriode [name="tanggal_awal"]').attr('required', 'required');
                    $('#divPeriode [name="tanggal_akhir"]').attr('required', 'required');
                    $('#divTerhitung [name="tanggal_awal"]').removeAttr('required');
                }

            });
        }
    }
</script>