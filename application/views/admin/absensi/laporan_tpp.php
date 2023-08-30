<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Laporan TPP Pegawai</h4>
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
                                    <select name="id_skpd" class="form-control select2" required>
                                        <?php
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
                                <button type="submit" value="1" name="filter"
                                    class="btn btn-primary m-t-5 btn-outline"><i class="ti-filter"></i>Filter</button>
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
                <div class="row">
                    <div class="col-md-12">
                        <a href="<?= base_url("absensi/laporan_tpp/download_laporan/$id_skpd/$bulan/$tahun") ?>"
                            class="btn btn-primary pull-right"><span class="btn-label"><i
                                    class="ti-download"></i></span> Download Laporan TPP Pegawai </a>
                    </div>
                </div>
                <hr>
                <center>
                    <span style="display: block;font-weight:500">LAPORAN TPP PEGAWAI</span>
                    <span style="display: block;font-weight:500;font-size:20px">
                        <?= $selected_skpd->nama_skpd ?>
                    </span>
                    <span style="display: block;font-weight:400">Bulan
                        <?= bulan($bulan) ?> Tahun
                        <?= $tahun ?>
                    </span>
                </center>
                <div class="table-responsive">
                    <table class="table table-stripped" id="myTable">
                        <thead>
                            <tr>
                                <th rowspan="2" width='20px'>NO</th>
                                <th rowspan="2">NIP</th>
                                <th rowspan="2">Nama</th>
                                <th rowspan="2">Jabatan</th>
                                <th colspan="3" style="text-align: center;">Kinerja</th>
                                <th rowspan="2" width="10%">Pagu TPP</th>
                                <th colspan="3" width="10%" style="text-align: center;">Pengurangan</th>
                                <th rowspan="2" width="10%">Besar TPP</th>
                                <th rowspan="2" width="10%">PPh 21</th>
                                <th rowspan="2" width="10%">Jumlah Dibayar</th>
                                <th rowspan="2" width="10%">Aksi</th>
                            </tr>
                            <tr>
                                <th>Kuantitas</th>
                                <th>Kualitas</th>
                                <th>Rata Rata</th>
                                <th>LKH</th>
                                <th>Absen</th>
                                <th>Hukdis</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($dt_pegawai)) {
                                $no = 1;
                                foreach ($dt_pegawai as $row) {
                                    if (isset($_GET['testing'])) {
                                        if ($row->id_pegawai != 1573) {
                                            continue;
                                        }
                                    }
                                    // $jabatan = !empty($row->nama_jabatan_lama) ? $row->nama_jabatan_lama : $row->nama_jabatan_sekarang;
                                    // $grade = !empty($row->nama_jabatan_lama) ? $row->grade_lama : $row->grade_sekarang;
                                    // $tpp = !empty($row->nama_jabatan_lama) ? $row->tpp_lama : $row->tpp_sekarang;
                                    // $id_skpd = !empty($row->nama_jabatan_lama) ? $row->id_skpd_lama : $row->id_skpd_sekarang;
                                    $jenis_potongan = ['lkh', 'absen', 'hukdis'];
                                    $cek_tpp = $this->tpp_perhitungan_model->cek_tidak_dapat_tpp($row->id_pegawai, $bulan, $tahun);

                                    $tpp = 0;
                                    $hasil_pengurangan = 0;
                                    $pph21 = 0;
                                    $dibayar = 0;
                                    if ($cek_tpp) {
                                        $list_potongan = array();
                                        foreach ($jenis_potongan as $j) {
                                            $list_potongan[$j] = 0;
                                        }
                                    } else {

                                        if ($static_data) {
                                            $tpp = $row->tpp;
                                            $pajak = $row->pph;
                                        } else {
                                            $get_tpp = $this->tpp_perhitungan_model->get_tpp($row->id_pegawai);
                                            // var_dump($get_tpp);
                                            $tpp = !empty($get_tpp) ? $get_tpp['tpp'] : 0;
                                            $pajak = $this->tpp_perhitungan_model->get_pajak($row->id_pegawai);
                                        }

                                        $list_potongan = array();
                                        foreach ($jenis_potongan as $j) {
                                            $list_potongan[$j] = $this->tpp_perhitungan_model->get_potongan_by_jenis($row->id_pegawai, $bulan, $tahun, $j);
                                        }


                                        $potongan = $this->tpp_perhitungan_model->get_potongan($row->id_pegawai, $bulan, $tahun);
                                        if ($potongan) {
                                            $potongan = round($potongan->jml_potongan);
                                        } else {
                                            $potongan = 0;
                                        }
                                        $hasil_pengurangan = $tpp - $potongan;
                                        if (isset($_GET['testing'])) {
                                            // $potongan = (int) $potongan;
                                            // $tpp = (int) $tpp;
                                            $hasil_pengurangan = round($tpp - $potongan);
                                        }

                                        if (!empty($pajak)) {
                                            $pph21 = $hasil_pengurangan * $pajak / 100;
                                        } else {
                                            $pph21 = 0;
                                        }
                                        $dibayar = $hasil_pengurangan - $pph21;
                                    }
                                    ?>
                                    <tr>
                                        <td align="center">
                                            <?= $no; ?>
                                        </td>
                                        <td>
                                            <?= $row->nip; ?>
                                        </td>
                                        <td>
                                            <?= $row->nama_lengkap ?>
                                        </td>
                                        <td>
                                            <?= $row->jabatan ?>
                                        </td>
                                        <td><?= $row->kinerja_kuantitas ?>%</td>
                                        <td><?= $row->kinerja_kualitas ?>%</td>
                                        <td><?= round(($row->kinerja_kualitas + $row->kinerja_kuantitas) / 2, 2) ?>%</td>
                                        <td>
                                            <?= rupiah($tpp) ?>
                                        </td>
                                        <td>
                                            <?= rupiah($list_potongan['lkh']) ?>
                                        </td>
                                        <td>
                                            <?= rupiah($list_potongan['absen']) ?>
                                        </td>
                                        <td>
                                            <?= rupiah($list_potongan['hukdis']) ?>
                                        </td>
                                        <td>
                                            <?= rupiah($hasil_pengurangan) ?>
                                        </td>
                                        <td>
                                            <?= rupiah($pph21) ?>
                                        </td>
                                        <td>
                                            <?= rupiah($dibayar) ?>
                                        </td>
                                        <td>
                                            <a href="javascript:void(0)" onclick="detailPengurangan(<?= $row->id_pegawai ?>)"
                                                class="btn btn-primary">Detail Pengurangan</a>
                                        </td>

                                    </tr>
                                    <?php $no++;
                                }
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- sample modal content -->
<div class="modal fade bs-example-modal-lg" id="modalPengurangan" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myLargeModalLabel">Detail Pengurangan</h4>
            </div>
            <div class="modal-body">
                <table>
                    <tr>
                        <td>NIP</td>
                        <td width="20">:</td>
                        <td style="font-weight: 500;" id="sNIP"></td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td style="font-weight: 500;" id="sNama"></td>
                    </tr>
                    <tr>
                        <td>Jabatan</td>
                        <td>:</td>
                        <td style="font-weight: 500;" id="sJabatan"></td>
                    </tr>
                </table>
                <hr>
                <div class="table-responsive">
                    <table class="table color-table primary-table" id="tblPengurangan">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Keterangan</th>
                                <th>Persen</th>
                                <th>Nominal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan='4'>Tidak ada pengurangan</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan='2' style="font-weight: 500;">TOTAL</td>
                                <td id="sTotalPersen" style="font-weight: 500;">0%</td>
                                <td id="sTotalNominal" style="font-weight: 500;">Rp.0</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script>
    function detailPengurangan(id_pegawai) {
        $.getJSON("<?= base_url('absensi/laporan_tpp/get_pengurangan_tpp') ?>/" + id_pegawai + "/<?= $bulan ?>/<?= $tahun ?>", function (data) {
            // console.log(data);
            $("#sNIP").html(data.pegawai.nip);
            $("#sNama").html(data.pegawai.nama_lengkap);
            $("#sJabatan").html(data.pegawai.jabatan);
            var datas = "";
            $.each(data.pengurangan, function (key, val) {
                datas += "<tr>";
                datas += "<td>" + parseInt(key + 1) + "</td>";
                datas += "<td>" + val.keterangan + "</td>";
                datas += "<td>" + val.persen_potongan + "%</td>";
                datas += "<td>" + val.nominal_potongan + "</td>";
                datas += "</tr>";
            });
            if (datas == "") {
                datas += "<tr><td colspan='4'>Tidak ada pengurangan</td></tr>"
            }
            $('#tblPengurangan tbody').html(datas);
            $("#sTotalPersen").html(data.total_persen + "%");
            $("#sTotalNominal").html(data.total_nominal);
            $('#modalPengurangan').modal('show');
        });
    }
</script>