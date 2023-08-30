<html>
<style>
    .judul {
        text-align: center;
        margin-bottom: 10px;
    }

    .judul span {
        font-weight: bold;
    }

    body {
        font-family: 'Times New Roman', Times, serif
    }

    table.utama,
    .utama td,
    .utama th {
        border: 1px solid #222;
        text-align: left;
    }

    .utama th {
        padding: 5px;
        text-align: center;
    }

    table.utama,
    table.titimangsa {
        border-collapse: collapse;
        width: 100%;
        table-layout: fixed;
    }

    th,
    td {
        font-size: 10px;
        word-wrap: break-word;
    }

    .utama td {
        padding: 5px;
    }
</style>

<body>
    <div class="judul" style="position:relative">
        <div>
            <span style="display: block;">REKAPITULASI PERJALANAN DINAS LUAR DAERAH</span>
            <span style="display: block;"><?= $pegawai->nama_lengkap ?></span>
            <span style="display: block;">BULAN : <?= strtoupper(bulan($bulan)) ?> <?= $tahun ?></span>
        </div>
    </div>
    <table border="1" class="utama">
        <thead>
            <tr>
                <th style="width: 3%;">NO</th>
                <th style="width: 8%;">NO/TGL SURAT PERINTAH</th>
                <th>BAGIAN</th>
                <th>MAKSUD</th>
                <th style="width: 6%;">Biaya<br>Transpor<br>(Rp)</th>
                <th style="width: 6%;">Uang<br>Refrentasi</th>
                <th style="width: 3%;">Vol</th>
                <th style="width: 6%;">Uang Harian<br>(Rp)</th>
                <th style="width: 6%;">Jumlah</th>
                <th style="width: 3%;">Vol</th>
                <th style="width: 6%;">Biaya<br>Penginapan<br>(Rp)</th>
                <th style="width: 6%;">Jumlah</th>
                <th style="width: 6%;">Total</th>
            </tr>
            <tr>
                <?php
                $jmlcol = 13;
                for ($i = 1; $i <= $jmlcol; $i++) {
                    echo " <th style='padding:0px'>$i</th>";
                }
                ?>

            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $jumlah_transport = 0;
            $jumlah_refresentasi = 0;
            $jumlah_uh = 0;
            $jumlah_total_uh = 0;
            $jumlah_bp = 0;
            $jumlah_total_bp = 0;
            $jumlah_total = 0;
            foreach ($list as $k => $p) {
                $detail = $this->perjalanan_dinas_model->get_by_id($p->id_perjalanan_dinas);
                $jumlah_uh += $p->nominal_uh;
                $jumlah_total_uh += ($p->nominal_uh * $p->volume_uh);
                $jumlah_bp += $p->nominal_bp;
                $jumlah_total_bp += ($p->nominal_bp * $p->volume_bp);
                if ($p->is_koordinator == "Y") {
                    $total = ($p->nominal_bp * $p->volume_bp) + ($p->nominal_uh * $p->volume_uh) + $detail->biaya_transport + $detail->uang_refresentasi;
                    $jumlah_transport += $detail->biaya_transport;
                    $jumlah_refresentasi += $detail->uang_refresentasi;
                } else {
                    $total = ($p->nominal_bp * $p->volume_bp) + ($p->nominal_uh * $p->volume_uh);
                }

                if ($k % 2 !== 0) {
                    $style_ttd = ' style="text-align:right"';
                } else {
                    $style_ttd = '';
                }
                $jumlah_total += $total;
            ?>
                <tr>
                    <td style="text-align: center;"><?= $no ?></td>
                    <td><?= $p->no_sp ?> <?= tanggal($p->tanggal_sp) ?></td>
                    <td><?= $p->nama_unit_kerja ?></td>
                    <td><?= $detail->deskripsi_kegiatan ?></td>
                    <td style="text-align: right;"><?= $p->is_koordinator == "Y" ? number_format($detail->biaya_transport, 0, ',', '.') : null ?></td>
                    <td style="text-align: right;"><?= $p->is_koordinator == "Y" ? number_format($detail->uang_refresentasi, 0, ',', '.') : null ?></td>
                    <td style="text-align: center;"><?= $p->volume_uh ?></td>
                    <td style="text-align: right;"><?= number_format($p->nominal_uh, 0, ',', '.') ?></td>
                    <td style="text-align: right;"><?= number_format($p->nominal_uh * $p->volume_uh, 0, ',', '.') ?></td>
                    <td style="text-align: center;"><?= $p->volume_bp ?></td>
                    <td style="text-align: right;"><?= number_format($p->nominal_bp, 0, ',', '.') ?></td>
                    <td style="text-align: right;"><?= number_format($p->nominal_bp * $p->volume_bp, 0, ',', '.') ?></td>
                    <td style="text-align: right;"><?= number_format($total, 0, ',', '.') ?></td>
                </tr>
            <?php
                $no += 1;
            }
            ?>
            <tr style="background-color: #cdcdcd;">
                <td></td>
                <td colspan="3">
                </td>
                <td style="font-weight: bold;text-align: right;"><?= number_format($jumlah_transport, 0, ',', '.') ?></td>
                <td style="font-weight: bold;text-align: right;"><?= number_format($jumlah_refresentasi, 0, ',', '.') ?></td>
                <td></td>
                <td style="font-weight: bold;text-align: right;"><?= number_format($jumlah_uh, 0, ',', '.') ?></td>
                <td style="font-weight: bold;text-align: right;"><?= number_format($jumlah_total_uh, 0, ',', '.') ?></td>
                <td></td>
                <td style="font-weight: bold;text-align: right;"><?= number_format($jumlah_bp, 0, ',', '.') ?></td>
                <td style="font-weight: bold;text-align: right;"><?= number_format($jumlah_total_bp, 0, ',', '.') ?></td>
                <td style="font-weight: bold;text-align: right;"><?= number_format($jumlah_total, 0, ',', '.') ?></td>
            </tr>
        </tbody>
    </table>
    <table class="titimangsa" style="margin-top: 20px;">
        <tr>
            <td style="text-align: center;">
                Mengetahui:<br>
                Kepala Bagian Umum<br>
                Setda Kab. Sumedang,<br><br><br><br><br><br>
                <span style="text-decoration: underline;font-weight: bold;font-size:13px"><?= $kabag->nama_lengkap ?></span><br>
                <span>NIP. <?= $kabag->nip ?></span>
            </td>
            <td style="text-align: center;">
                <br>
                <br>
                PPTK<br><br><br><br><br><br>
                <span style="text-decoration: underline;font-weight: bold;font-size:13px"><?= $pptk->nama_lengkap ?></span><br>
                <span>NIP. <?= $pptk->nip ?></span>
            </td>
            <td style="text-align: center;">
                <br>
                <br>
                Bendahara Pengeluaran<br><br><br><br><br><br>
                <span style="text-decoration: underline;font-weight: bold;font-size:13px"><?= $bendahara->nama_lengkap ?></span><br>
                <span>NIP. <?= $bendahara->nip ?></span>
            </td>
            <td style="text-align: center;">
                <br>
                <br>BPP<br><br><br><br><br><br>
                <span style="text-decoration: underline;font-weight: bold;font-size:13px"><?= $bpp->nama_lengkap ?></span><br>
                <span>NIP. <?= $bpp->nip ?></span>
            </td>
        </tr>
    </table>
</body>

</html>