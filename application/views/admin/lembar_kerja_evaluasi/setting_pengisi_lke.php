<style>
    .panel-warning a {
        color: #FFFFFF !important;
    }

    .label-white {
        background-color: #FFFFFF;
        color: blueviolet;
    }
</style>
<div class="container-fluid">

    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">LKE - <?= $nama ?></h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li>Lembar Kerja Evaluasi</li>
                <li class="active"><?= $nama ?></li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <?php
                if (isset($message)) {
                ?>
                    <div class="alert alert-<?= $message_type ?>"><?= $message ?></div>
                <?php } ?>
                <?php
                if (!empty($this->session->flashdata('message'))) {
                ?>
                    <div class="alert alert-<?= $this->session->flashdata('type') ?>"><?= $this->session->flashdata('message') ?></div>
                <?php } ?>


                <?php
                $year = date('Y');
                ?>
                <form action="<?= base_url('lembar_kerja_evaluasi/pokja_filter_zi/') ?>" method="post">
                    <div class="row">
                        <div class="col-md-10">
                            <select name="tahun" class="form-control" style="margin-bottom: 30px;">
                                <option selected>Pilih Tahun Anggaran</option>
                                <?php for ($awal_tahun = $year; $awal_tahun <= 2023; $awal_tahun++) {  ?>
                                    <option value="<?= $awal_tahun; ?>"><?= $awal_tahun; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary btn-block">Filter</button>
                        </div>
                    </div>
                </form>
                <div class="alert alert-info" role="alert">
                    <b>SETTING KETUA POKJA/PENGISI LKE ZI - PER PERANGKAT DAERAH, PER TAHUN (<?= $tahun ?>)</b>
                </div>
                <hr>
                <a class="btn btn-primary" data-toggle="modal" data-target="#tambahPokja">Tambah Pokja</a>
                <hr>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Nama Pokja</th>
                                <th scope="col">Ketua Pokja</th>
                                <th scope="col">Indikator LKE</th>
                                <th scope="col">Tahun</th>
                                <th scope="col">Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($pokja as $rows) {
                            ?>
                                <tr>
                                    <th scope="row"><?= $no++ ?></th>
                                    <td><?= $rows->nama_pokja ?></td>

                                    <td><?= $rows->nama_lengkap ?></td>
                                    <td>
                                        <?php if ($rows->jenis == 'zi_wbk') {
                                            echo "<b style='color:#4285F4;'>ZI WBK</b>";
                                        } else {
                                            echo "<b style='color:#34A853;'>RB</b>";
                                        }
                                        ?>
                                        - <b><?php echo  $rows->nama_induk ?></b>
                                        - <?= $rows->nama_indikator ?>

                                    </td>
                                    <td><?= $rows->tahun ?></td>
                                    <td>
                                        <a class="btn btn-primary" data-toggle="modal" data-target="#editPengisi<?= $rows->id ?>">Edit</a>
                                    </td>
                                </tr>

                                <div class="modal fade" id="editPengisi<?= $rows->id ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title" id="myLargeModalLabel">Edit Pokja</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div id="message"></div>
                                                <form id="formJawaban" action="<?= base_url('lembar_kerja_evaluasi/p_edit_pokja/') ?>" method="post" enctype="multipart/form-data">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label class="control-label" for="inputSuccess2">Input Nama Pokja</label>
                                                            <input type="hidden" value="<?= $rows->id ?>" name="id">
                                                            <select name="nama_pokja" class="form-control">
                                                                <option value="<?= $rows->nama_pokja ?>"><?= $rows->nama_pokja ?></option>
                                                                <option value="KELOMPOK KERJA BIDANG MANAJEMEN PERUBAHAN">KELOMPOK KERJA BIDANG MANAJEMEN PERUBAHAN</option>
                                                                <option value="KELOMPOK KERJA BIDANG PENATAAN TATALAKSANA">KELOMPOK KERJA BIDANG PENATAAN TATALAKSANA</option>
                                                                <option value="KELOMPOK KERJA BIDANG PENATAAN SISTEM MANAJEMEN SDM">KELOMPOK KERJA BIDANG PENATAAN SISTEM MANAJEMEN SDM</option>
                                                                <option value="KELOMPOK KERJA BIDANG PENGUATAN AKUNTABILITAS KINERJA">KELOMPOK KERJA BIDANG PENGUATAN AKUNTABILITAS KINERJA</option>
                                                                <option value="KELOMPOK KERJA BIDANG PENGUATAN PENGAWASAN">KELOMPOK KERJA BIDANG PENGUATAN PENGAWASAN</option>
                                                                <option value="KELOMPOK KERJA BIDANG PENINGKATAN KUALITAS PELAYANAN PUBLIK">KELOMPOK KERJA BIDANG PENINGKATAN KUALITAS PELAYANAN PUBLIK</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="control-label" for="inputSuccess2">Nama Ketua Pokja</label>
                                                            <select name="id_pegawai" class="form-control">
                                                                <option value="<?= $rows->id_pegawai_ketua ?>"><?= $rows->nama_lengkap ?></option>
                                                                <?php foreach ($pegawai as $p) { ?>
                                                                    <option value="<?= $p->id_pegawai ?>"><?= $p->nama_lengkap ?></option>
                                                                <?php } ?>
                                                            </select>

                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="control-label" for="inputSuccess2">Nama Indikator</label>
                                                            <select name="id_lke_indikator" class="form-control">
                                                                <option value="<?= $rows->id_lke_indikator ?>"><?= $rows->nama_indikator ?> (<?= $rows->tahun ?>)</option>
                                                                <?php foreach ($indikator as $keys) { ?>
                                                                    <option value="<?= $keys->id_indikator ?>">
                                                                        <?php if ($keys->jenis_lke == 'zi_wbk') {
                                                                            echo "ZI WBK";
                                                                        } else {
                                                                            echo "RB";
                                                                        }
                                                                        ?>
                                                                        - <?= $keys->nama_induk ?>-<?= $keys->nama_indikator ?> (<?= $keys->tahun ?>)
                                                                    </option>

                                                                <?php } ?>
                                                            </select>
                                                        </div>


                                                    </div>
                                                    <br>

                                            </div>
                                            <div class=" modal-footer">
                                                <a href="javascript:void(0)" data-dismiss="modal" class="btn btn-default waves-effect text-left">Batal</a>
                                                <button type="submit" id="btnSimpan" class="btn btn-primary waves-effect text-left">Simpan</button>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>




<div class="modal fade" id="tambahPokja" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myLargeModalLabel">Tambah Pokja</h4>
            </div>
            <div class="modal-body">
                <div id="message"></div>
                <form id="formJawaban" action="<?= base_url('lembar_kerja_evaluasi/setting_pengisi_lke/') ?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            <label class="control-label" for="inputSuccess2">Input Nama Pokja</label>
                            <select name="nama_pokja" class="form-control">
                                <option value="">Pilih Nama Pokja</option>
                                <option value="KELOMPOK KERJA BIDANG MANAJEMEN PERUBAHAN">KELOMPOK KERJA BIDANG MANAJEMEN PERUBAHAN</option>
                                <option value="KELOMPOK KERJA BIDANG PENATAAN TATALAKSANA">KELOMPOK KERJA BIDANG PENATAAN TATALAKSANA</option>
                                <option value="KELOMPOK KERJA BIDANG PENATAAN SISTEM MANAJEMEN SDM">KELOMPOK KERJA BIDANG PENATAAN SISTEM MANAJEMEN SDM</option>
                                <option value="KELOMPOK KERJA BIDANG PENGUATAN AKUNTABILITAS KINERJA">KELOMPOK KERJA BIDANG PENGUATAN AKUNTABILITAS KINERJA</option>
                                <option value="KELOMPOK KERJA BIDANG PENGUATAN PENGAWASAN">KELOMPOK KERJA BIDANG PENGUATAN PENGAWASAN</option>
                                <option value="KELOMPOK KERJA BIDANG PENINGKATAN KUALITAS PELAYANAN PUBLIK">KELOMPOK KERJA BIDANG PENINGKATAN KUALITAS PELAYANAN PUBLIK</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="control-label" for="inputSuccess2">Nama Ketua Pokja</label>
                            <select name="id_pegawai" class="form-control">
                                <?php foreach ($pegawai as $p) { ?>
                                    <option value="<?= $p->id_pegawai ?>"><?= $p->nama_lengkap ?></option>
                                <?php } ?>
                            </select>

                        </div>
                        <div class="col-md-6">
                            <label class="control-label" for="inputSuccess2">Nama Indikator</label>
                            <select name="id_lke_indikator" class="form-control">
                                <?php foreach ($indikator as $keys) { ?>
                                    <option value="<?= $keys->id_indikator ?>">
                                        <?php if ($keys->jenis_lke == 'zi_wbk') {
                                            echo "ZI WBK";
                                        } else {
                                            echo "RB";
                                        }
                                        ?>
                                        -
                                        <?= $keys->nama_induk ?>-<?= $keys->nama_indikator ?> (<?= $keys->tahun ?>)
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <br>
            </div>
            <div class=" modal-footer">
                <a href="javascript:void(0)" data-dismiss="modal" class="btn btn-default waves-effect text-left">Batal</a>
                <button type="submit" id="btnSimpan" class="btn btn-primary waves-effect text-left">Simpan</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>