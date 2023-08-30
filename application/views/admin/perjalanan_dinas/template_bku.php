<?php 
// header("Content-type: application/octet-stream");
// header("Content-Disposition: attachment; filename=abc.xls");
// header("Pragma: no-cache");
// header ("Expires: 0");
?>
<html>
<style>
    .judul {
        text-align: center;
        margin-bottom: 10px;
    }

    .judul span {
        font-weight: bold;
        font-size:13px;
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

    table.utama, table.titimangsa {
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
    <div >
        <span style="display: block;">PEMERINTAH KABUPATEN SUMEDANG</span>
        <span style="display: block;">BUKU KAS UMUM</span>
        <span style="display: block;">BENDAHARA PENGELUARAN PEMBANTU</span>
        <br>
        <span style="display: block;">PENYELENGGARAAN RAPAT KOORDINASI DAN KONSULTASI SKPD</span>
        </div>
    </div>
    <table>
        <tr>
            <td>SKPD</td>
            <td>:</td>
            <td><?=$uk->nama_unit_kerja?> Setda Kabupaten Sumedang</td>
        </tr>
        <tr>
            <td>KPA</td>
            <td>:</td>
            <td></td>
        </tr>
        <tr>
            <td>Nama/Kode Keg</td>
            <td>:</td>
            <td></td>
        </tr>
        <tr>
            <td>BPP</td>
            <td>:</td>
            <td><?=$bpp->nama_lengkap?></td>
        </tr>
        <tr>
            <td>Tahun Anggaran</td>
            <td>:</td>
            <td><?=$tahun?></td>
        </tr>
    </table>
    <table border="1" class="utama" style="margin-top:20px;">
        <thead>
            <tr>
                <th style="width: 5%;">NO</th>
                <th>Tanggal</th>
                <th>Uraian</th>
                <th>Kode Rekening</th>
                <th>Penerimaan</th>
                <th>Pengeluaran</th>
                <th>Saldo</th>
                <th>Bukti SPJ</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no=1;
    foreach($list as $l){
        $detail = $this->perjalanan_dinas_model->get_by_id($l->id_perjalanan_dinas);
        $pembiayaan = $this->perjalanan_dinas_model->get_pembiayaan($l->id_perjalanan_dinas);
            $jumlah_transport = 0;
            $jumlah_refresentasi = 0;
            $jumlah_uh = 0;
            $jumlah_total_uh = 0;
            $jumlah_bp = 0;
            $jumlah_total_bp = 0;
            $jumlah_total = 0;
            foreach ($pembiayaan as $k => $p) {
                $jumlah_uh += $p->nominal_uh;
                $jumlah_total_uh += ($p->nominal_uh * $p->volume_uh);
                $jumlah_bp += $p->nominal_bp;
                $jumlah_total_bp += ($p->nominal_bp * $p->volume_bp);
                if ($k == 0) {
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
            <?php
            }
            ?>
            
            <tr>
                    <td style="text-align: center;"><?= $no ?></td>
                    <td style="text-align: center;"><?= tanggal(date("Y-m-d", strtotime($l->tanggal))); ?></td>
                    <td style="text-align: center;"><?= $l->deskripsi_kegiatan ?></td>
                    <td style="text-align: center;"><?= $l->kode_rekening ?></td>
                    <td style="text-align: right;">-</td>
                    <td style="text-align: right;"><?=number_format($jumlah_total,0,',','.')?></td>
                    <td></td>
                    <td></td>
            </tr>
            <?php 
                $no += 1;
                } ?>
        </tbody>
    </table>
    <table class="titimangsa" style="margin-top: 20px;">
        <!-- <tr>
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
                <span style="text-decoration: underline;font-weight: bold;font-size:13px"><?= $bpp->nama_lengkap?></span><br>
                <span>NIP.  <?=$bpp->nip?></span>
            </td>
        </tr> -->
    </table>
</body>

</html>