<div class="container-fluid">
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Buat Jadwal Kegiatan</h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

            <ol class="breadcrumb">
                <li><a href="<?= base_url('admin') ?>">Dashboard</a></li>
                <li><a href="<?= base_url('kegiatan_dewan') ?>">Manajemen Kegiatan</a></li>
                <li class="active">Buat Jadwal Kegiatan</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <?= form_open_multipart() ?>
                <?php
                if (isset($message)) {
                    echo '<div class="alert alert-' . $type . '">' . $message . '</div>';
                }
                ?>
                <div class="form-group">
                    <label>Nama Kegiatan</label>
                    <input type="text" autocapitalize="on" value="<?= set_value('nama_kegiatan') ?>" class="form-control" name="nama_kegiatan" placeholder="Masukkan Nama Kegiatan" />
                    <?php echo form_error('nama_kegiatan', '<div class="text-danger"><small>', '</small></div>'); ?>
                </div>
                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea class="form-control" name="deskripsi_kegiatan" placeholder="Masukkan Deskripsi"><?= set_value('deskripsi_kegiatan') ?></textarea>
                    <?php echo form_error('deskripsi_kegiatan', '<div class="text-danger"><small>', '</small></div>'); ?>
                </div>
                <div class="form-group">
                    <label>Tanggal Pelaksanaan</label>
                    <input type="text" id="mydatepicker" value="<?= set_value('tanggal') ?>" autocomplete="off" class="form-control mydatepicker" name="tanggal" placeholder="Masukkan Tanggal Pelaksanaan Kegiatan" />
                    <?php echo form_error('tanggal', '<div class="text-danger"><small>', '</small></div>'); ?>
                </div>
                <div class="form-group">
                    <label>Lokasi</label>
                    <input type="text" value="<?= set_value('lokasi') ?>" class="form-control" name="lokasi" placeholder="Masukkan Lokasi Kegiatan" />
                </div>
                <div class="form-group">
                    <label>Foto Kegiatan</label>
                    <small>File yang diizinkan : (jpg,jpeg,png)</small>
                    <input type="file" name="foto_kegiatan" class="dropify" />
                </div>
                <div class="form-group">
                    <label>Lampiran</label>
                    <small>File yang diizinkan : (jpg,jpeg,png,doc,docx,ppt,pptx,xls,xlsx,zip,rar,mp4)</small>
                    <input type="file" name="lampiran" class="dropify" />
                </div>

                <div class="form-group">
                    <label>Daftar Peserta</label>
                    <?php echo form_error('list_peserta[]', '<div class="text-danger"><small>', '</small></div>'); ?>
                    <!-- <input type="text" class="form-control" name="peserta[]" placeholder="Pilih Peserta Kegiatan" /> -->
                    <select id='pre-selected-options' multiple='multiple' name="list_peserta[]">
                        <?php
                        foreach ($pegawai as $p) {
                            echo '<option value="' . $p->id_pegawai . '">' . $p->nama_lengkap . ' - ' . $p->jabatan . '</option>';
                        }
                        ?>

                    </select>
                </div>
                <div class="row">
                    <div class="col-md-12">

                        <a href="<?= base_url('kegiatan_dewan') ?>" class="btn btn-primary btn-outline pull-right" style="margin-left:10px">Batal</a>
                        <button type="submit" class="btn btn-primary pull-right"><i class="ti-save"></i> Simpan</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleJenisKegiatan() {
        var jenis_kegiatan = $('[name="jenis_kegiatan"]:checked').val()
        if (jenis_kegiatan == 'online') {
            $('#divKegiatanOnline').show();
            $('#divKegiatanOffline').hide();
        } else if (jenis_kegiatan == 'offline') {
            $('#divKegiatanOnline').hide();
            $('#divKegiatanOffline').show();
        } else {
            $('#divKegiatanOnline').hide();
            $('#divKegiatanOffline').hide();
        }
    }

    function toggleAutentikasi() {
        var autentikasi = $('[name="autentikasi"]').prop('checked');
        if (autentikasi) {
            $('#divAutentikasi').show();
        } else {
            $('#divAutentikasi').hide();
        }
    }
</script>