<style>
    th {
        text-align: center;
    }
    td{
        padding-top:5px !important;
        padding-bottom:5px !important;
    }
</style>
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Statistik Desa</h4>
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
                <form method="GET">
                    <div class="row">
                        <div class="col-md-3">
                            <label>Kecamatan</label>
                            <select name="id_kecamatan" class="form-control select2">
                                <option value="">Semua Kecamatan</option>
                                <?php
                                foreach ($kecamatan as $k) {
                                    $selected = $id_kecamatan == $k->id_skpd ? ' selected' : null;
                                    echo '<option value="' . $k->id_skpd . '"'.$selected.'>' . $k->nama_skpd . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label style="display: block;">&nbsp;</label>
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="white-box">
                <?php 
                    $get_data = json_decode(curlMadasih('get_statistik_surat/'.$id_kecamatan));
                    if($id_kecamatan!==''){
                        $detail_kecamatan = $get_data->detail_kecamatan;
                    }
                    $skpd = $get_data->list;
                ?>
                <div class="m-b-20 text-center">
                    <span style="font-weight: 500;font-size:16px;display:block">PERINGKAT PENGGUNAAN SURAT E-OFFICE DESA</span>
                    <span style="font-weight: 500;font-size:16px;display:block"><?=$detail_kecamatan ? $detail_kecamatan->nama_skpd : 'KABUPATEN SUMEDANG'?></span>
                </div>
                <table class="table color-table primary-table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Desa</th>
                            <th>Jumlah Tandatangan</th>
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
                                <td><b><?= $s->jumlah_ttd ?></b> Surat <small>dari <?=$s->jumlah_surat?> surat</small></td>
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