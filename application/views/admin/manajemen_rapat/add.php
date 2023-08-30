<div class="container-fluid">
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Buat Jadwal Rapat</h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

            <ol class="breadcrumb">
                <li><a href="<?= base_url('admin') ?>">Dashboard</a></li>
                <li><a href="<?= base_url('manajemen_rapat') ?>">Manajemen Rapat</a></li>
                <li class="active">Buat Jadwal Rapat</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <form method="POST">
                    <?php
                    if (isset($message)) {
                        echo '<div class="alert alert-' . $type . '">' . $message . '</div>';
                    }
                    ?>
                    <div class="form-group">
                        <label>Tema Rapat</label>
                        <input type="text" autocapitalize="on" value="<?= set_value('tema_rapat') ?>" class="form-control" name="tema_rapat" placeholder="Masukkan Tema Rapat" />
                        <?php echo form_error('tema_rapat', '<div class="text-danger"><small>', '</small></div>'); ?>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea class="form-control" name="deskripsi_rapat" placeholder="Masukkan Deskripsi"><?= set_value('deskripsi_rapat') ?></textarea>
                        <?php echo form_error('deskripsi_rapat', '<div class="text-danger"><small>', '</small></div>'); ?>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Pelaksanaan</label>
                        <input type="text" id="mydatepicker" value="<?= set_value('tanggal') ?>" autocomplete="off" class="form-control mydatepicker" name="tanggal" placeholder="Masukkan Tanggal Pelaksanaan Rapat" />
                        <?php echo form_error('tanggal', '<div class="text-danger"><small>', '</small></div>'); ?>
                    </div>
                    <div class="form-group">
                        <label>Jam Mulai</label>
                        <input type="time" class="form-control" value="<?= set_value('jam') ?>" name="jam" placeholder="Masukkan Jam Mulai Rapat" />
                        <?php echo form_error('jam', '<div class="text-danger"><small>', '</small></div>'); ?>
                    </div>
                    <div class="form-group">
                        <label style="display: block;">Jenis Rapat</label>
                        <div class="radio radio-primary" style="display: inline-block;margin-left:10px">
                            <input type="radio" name="jenis_rapat" id="jenis_rapat_offline" value="offline" onclick="toggleJenisRapat()" <?= set_value('jenis_rapat') == 'offline' || set_value('jenis_rapat') == '' ? 'checked' : null ?>>
                            <label for="jenis_rapat_offline"> Offline </label>
                        </div>
                        <div class="radio radio-primary" style="display: inline-block;">
                            <input type="radio" name="jenis_rapat" id="jenis_rapat_online" value="online" onclick="toggleJenisRapat()" <?= set_value('jenis_rapat') == 'online' ? 'checked' : null ?>>
                            <label for="jenis_rapat_online"> Online </label>
                        </div>
                        <?php echo form_error('jenis_rapat', '<div class="text-danger"><small>', '</small></div>'); ?>
                    </div>
                    <div class="form-group" id="divRapatOffline">
                        <label>Lokasi</label>
                        <input type="text" value="<?= set_value('lokasi') ?>" class="form-control" name="lokasi" placeholder="Masukkan Lokasi Rapat" />
                    </div>
                    <div id="divRapatOnline" style="display: none;">

                        <div class="form-group">
                            <label>Tautan Rapat Online <small>(Google Meet, Zoom, dll)</small></label>
                            <input type="text" value="<?= set_value('link_meeting') ?>" class="form-control" name="link_meeting" placeholder="Masukkan Tautan Rapat Online" />
                        </div>
                        <div class="form-group">
                            <label>Membutuhkan Autentikasi</label>
                            <input type="checkbox" name="autentikasi" value="Y" class="js-switch" data-color="#cc9353" onchange="toggleAutentikasi()" />
                        </div>
                        <div class="form-group" id="divAutentikasi" style="display: none;">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Username</label>
                                    <input value="<?= set_value('username') ?>" type="text" class="form-control" name="username" placeholder="Masukkan Username" />
                                </div>
                                <div class="col-md-6">
                                    <label>Password</label>
                                    <input value="<?= set_value('password') ?>" type="text" class="form-control" name="password" placeholder="Masukkan Password" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Daftar Peserta</label>
                        <?php echo form_error('list_peserta[]', '<div class="text-danger"><small>', '</small></div>'); ?>
                        <!-- <input type="text" class="form-control" name="peserta[]" placeholder="Pilih Peserta Rapat" /> -->
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

                            <a href="<?= base_url('manajemen_rapat') ?>" class="btn btn-primary btn-outline pull-right" style="margin-left:10px">Batal</a>
                            <button type="submit" class="btn btn-primary pull-right"><i class="ti-save"></i> Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleJenisRapat() {
        var jenis_rapat = $('[name="jenis_rapat"]:checked').val()
        if (jenis_rapat == 'online') {
            $('#divRapatOnline').show();
            $('#divRapatOffline').hide();
        } else if (jenis_rapat == 'offline') {
            $('#divRapatOnline').hide();
            $('#divRapatOffline').show();
        } else {
            $('#divRapatOnline').hide();
            $('#divRapatOffline').hide();
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