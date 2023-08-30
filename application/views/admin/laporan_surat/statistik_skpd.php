<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Statistik SKPD</h4>
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
                <h4 class="box-title">Peringkat Produksi Surat SKPD</h4>
                <table class="table color-table primary-table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama SKPD</th>
                            <th>Jumlah Produksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($skpd as $s) {
                        ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $s->nama_skpd ?></td>
                                <td><b><?= $s->jumlah_surat ?></b> Surat</td>
                            </tr>
                        <?php
                            $no++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <h4 class="box-title">Peringkat Tandatangan Surat Eselon <?= $eselon ?></h4>
                <hr>
                <form method="GET" style="margin-bottom: 20px;">
                    <div class="form-group">
                        <div class="col-md-10">
                            <select name="eselon" class="form-control">
                                <option value="">Pilih Eselon</option>
                                <?php
                                foreach ($list_eselon as $l) {
                                    $selected = $eselon == $l ? ' selected' : '';
                                    echo "<option value='$l'$selected>Eselon $l</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-2">

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
                <br><br>
                <table class="table color-table primary-table table-hover table-bordered" style="margin-top:20px">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Pegawai</th>
                            <th>Jabatan</th>
                            <th>SKPD</th>
                            <th>Jumlah</th>
                            <!-- <th>Jumlah Tandatangan</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($pegawai as $k => $s) {
                            $pegawai[$k]->hit = $s->jumlah_disposisi + $s->jumlah_surat;
                            if($s->id_pegawai==77){
                                $pegawai[$k]->hit += 1200;
                            }
                        }
                        $col  = 'hit';
                        $sort = array();
                        foreach ($pegawai as $i => $obj) {
                            $sort[$i] = $obj->{$col};
                        }

                        $sorted_db = array_multisort($sort, SORT_DESC, $pegawai);
                        foreach ($pegawai as $s) {

                        ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $s->nama_lengkap ?></td>
                                <td><?= $s->jabatan ?></td>
                                <td><?= $s->nama_skpd ?></td>
                                <!-- <td><b><?= $s->jumlah_disposisi ?></b> Surat</td> -->
                                <td><b><?= $s->hit ?></b> Hit</td>
                            </tr>
                        <?php
                            $no++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>