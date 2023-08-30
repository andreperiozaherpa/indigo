<link href="<?= base_url() ?>/asset/pixel/inverse/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<style type="text/css">
    body,
    html {
        font-family: 'Times New Roman', Times, serif;
        margin: 0px;
        padding: 40px;
    }

    .table thead>tr>th {
        font-weight: bold;
        text-align: center;
        font-size: 10px;
        border-color: #222;
        background-color: #f6f6f6;
    }

    h4 {
        margin-top: 0px;
        font-weight: 700;
    }

    .table tbody>tr>td {
        font-size: 11px;
        border-color: #222;
        text-align: justify-all;
    }

    .table {
        border-color: #222;
    }

    ol,
    ul {
        padding-left: 20px;
    }
</style>

<html>

<body>
    <center>
        <h4>LAPORAN TPP PEGAWAI</h4>
        <h4><?= $detail_skpd->nama_skpd ?></h4>
        <h4>Bulan <?= bulan($bulan) ?> Tahun <?= $tahun ?></h4>
    </center>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width='20px'>No</th>
                    <th>NIP</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th width="10%">Pagu TPP</th>
                    <th width="10%">Pengurangan</th>
                    <th width="10%">Besar TPP</th>
                    <th width="10%">PPh 21</th>
                    <th width="10%">Jumlah Dibayar</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($dt_pegawai)) {
                    $no = 1;
                    $total = array('pagu_tpp'=>0,'besar_tpp'=>0,'pengurangan'=>0,'pph21'=>0,'dibayar'=>0);
                    foreach ($dt_pegawai as $row) {
                        $get_tpp = $this->tpp_perhitungan_model->get_tpp($row->id_pegawai);
                        $tpp = !empty($get_tpp) ? $get_tpp['tpp'] : 0;
                        $pajak = $this->tpp_perhitungan_model->get_pajak($row->id_pegawai);

                        $potongan = $this->tpp_perhitungan_model->get_potongan($row->id_pegawai, $bulan, $tahun);
                        if ($potongan) {
                            $potongan = $potongan->jml_potongan;
                        } else {
                            $potongan = 0;
                        }
                        $hasil_pengurangan = $tpp - $potongan;

                        if (!empty($pajak)) {
                            $pph21 = $hasil_pengurangan * $pajak / 100;
                        } else {
                            $pph21 = 0;
                        }
                        $dibayar = $hasil_pengurangan - $pph21;

                        $total['pagu_tpp'] += $tpp;
                        $total['pengurangan'] += $potongan;
                        $total['besar_tpp'] += $hasil_pengurangan;
                        $total['pph21'] += $pph21;
                        $total['dibayar'] += $dibayar;

                ?>
                        <tr>
                            <td align="center"><?= $no; ?></td>
                            <td><?= $row->nip; ?></td>
                            <td><?= $row->nama_lengkap ?></td>
                            <td><?= $row->jabatan ?></td>
                            <td><?= rupiah($tpp) ?></td>
                            <td><?= rupiah($potongan) ?></td>
                            <td><?= rupiah($hasil_pengurangan) ?></td>
                            <td><?= rupiah($pph21) ?></td>
                            <td><?= rupiah($dibayar) ?></td>
                        </tr>
                <?php $no++;
                    }
                } ?>
                
                <tr>
                    <td colspan="4" style="text-align:center;background-color: #f6f6f6">
                        <span style="font-weight: bold;font-size:13px">JUMLAH</span>
                    </td>
                    <td style="font-weight: bold;font-size:13px;background-color: #f6f6f6"><?=rupiah($total['pagu_tpp'])?></td>
                    <td style="font-weight: bold;font-size:13px;background-color: #f6f6f6"><?=rupiah($total['pengurangan'])?></td>
                    <td style="font-weight: bold;font-size:13px;background-color: #f6f6f6"><?=rupiah($total['besar_tpp'])?></td>
                    <td style="font-weight: bold;font-size:13px;background-color: #f6f6f6"><?=rupiah($total['pph21'])?></td>
                    <td style="font-weight: bold;font-size:13px;background-color: #f6f6f6"><?=rupiah($total['dibayar'])?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <span style="margin-top: 8px;font-size:12px">
                Diunduh pada <?=tanggal(date('Y-m-d'))?> <?=date('H:i')?>
    </span>
</body>

</html>