<div class="container-fluid">
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Edit Jadwal Rapat</h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

            <ol class="breadcrumb">
                <li><a href="<?= base_url('admin') ?>">Dashboard</a></li>
                <li><a href="<?= base_url('manajemen_rapat') ?>">Manajemen Rapat</a></li>
                <li class="active">Edit Jadwal Rapat</li>
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
                        <input type="text" autocapitalize="on" value="<?= $detail->tema_rapat ?>" class="form-control" name="tema_rapat" placeholder="Masukkan Tema Rapat" />
                        <?php echo form_error('tema_rapat', '<div class="text-danger"><small>', '</small></div>'); ?>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea class="form-control" name="deskripsi_rapat" placeholder="Masukkan Deskripsi"><?= $detail->deskripsi_rapat ?></textarea>
                        <?php echo form_error('deskripsi_rapat', '<div class="text-danger"><small>', '</small></div>'); ?>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Pelaksanaan</label>
                        <input type="text" id="mydatepicker" value="<?= $detail->tanggal ?>" autocomplete="off" class="form-control mydatepicker" name="tanggal" placeholder="Masukkan Tanggal Pelaksanaan Rapat" />
                        <?php echo form_error('tanggal', '<div class="text-danger"><small>', '</small></div>'); ?>
                    </div>
                    <div class="form-group">
                        <label>Jam Mulai</label>
                        <input type="time" class="form-control" value="<?= $detail->jam ?>" name="jam" placeholder="Masukkan Jam Mulai Rapat" />
                        <?php echo form_error('jam', '<div class="text-danger"><small>', '</small></div>'); ?>
                    </div>
                    <div class="form-group">
                        <label style="display: block;">Jenis Rapat</label>
                        <div class="radio radio-primary" style="display: inline-block;margin-left:10px">
                            <input type="radio" name="jenis_rapat" id="jenis_rapat_offline" value="offline" onclick="toggleJenisRapat()" <?= $detail->jenis_rapat == 'offline' || $detail->jenis_rapat == '' ? 'checked' : null ?>>
                            <label for="jenis_rapat_offline"> Offline </label>
                        </div>
                        <div class="radio radio-primary" style="display: inline-block;">
                            <input type="radio" name="jenis_rapat" id="jenis_rapat_online" value="online" onclick="toggleJenisRapat()" <?= $detail->jenis_rapat == 'online' ? 'checked' : null ?>>
                            <label for="jenis_rapat_online"> Online </label>
                        </div>
                        <?php echo form_error('jenis_rapat', '<div class="text-danger"><small>', '</small></div>'); ?>
                    </div>
                    <div class="form-group" id="divRapatOffline">
                        <label>Lokasi</label>
                        <input type="text" value="<?= $detail->lokasi ?>" class="form-control" name="lokasi" placeholder="Masukkan Lokasi Rapat" />
                    </div>
                    <div id="divRapatOnline" style="display: none;">

                        <div class="form-group">
                            <label>Tautan Rapat Online <small>(Google Meet, Zoom, dll)</small></label>
                            <input type="text" value="<?= $detail->link_meeting ?>" class="form-control" name="link_meeting" placeholder="Masukkan Tautan Rapat Online" />
                        </div>
                        <div class="form-group">
                            <label>Membutuhkan Autentikasi</label>
                            <input type="checkbox" <?= $detail->autentikasi == 'Y' ? 'checked' : null ?> name="autentikasi" value="Y" class="js-switch" data-color="#cc9353" onchange="toggleAutentikasi()" />
                        </div>
                        <div class="form-group" id="divAutentikasi" style="display: none;">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Username</label>
                                    <input value="<?= $detail->username ?>" type="text" class="form-control" name="username" placeholder="Masukkan Username" />
                                </div>
                                <div class="col-md-6">
                                    <label>Password</label>
                                    <input value="<?= $detail->password ?>" type="text" class="form-control" name="password" placeholder="Masukkan Password" />
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
                            $selected_pegawai = [];
                            foreach ($peserta as $p) {
                                $selected_pegawai[] = $p->id_pegawai;
                            }
                            foreach ($pegawai as $p) {
                                if (in_array($p->id_pegawai, $selected_pegawai)) {
                                    $selected = ' selected';
                                } else {
                                    $selected = '';
                                }
                                echo '<option value="' . $p->id_pegawai . '"' . $selected . '>' . $p->nama_lengkap . ' - ' . $p->jabatan . '</option>';
                            }
                            ?>

                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-12">

                            <a href="<?= base_url('manajemen_rapat/detail/' . $detail->id_rapat) ?>" class="btn btn-primary btn-outline pull-right" style="margin-left:10px">Batal</a>
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
    $(document).ready(function() {
        toggleJenisRapat();
        toggleAutentikasi();
    });
</script>