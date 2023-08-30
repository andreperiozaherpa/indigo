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
        font-size: 11px;
        border-color: #222;
        background-color: #f6f6f6;
    }

    h4 {
        margin-top: 0px;
        font-weight: 700;
    }

    .table tbody>tr>td {
        font-size: 12px;
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
        <h4>CATATAN HARIAN KERJA PEGAWAI
            <br><?= !empty($bulan) ? 'BULAN ' . strtoupper($bulan) : '' ?> <?= !empty($bulan) ? 'TAHUN ' . $tahun : '' ?>
        </h4>
    </center>
    <table style="margin-bottom: 20px;">
        <tr>
            <td width='150px'>NAMA</td>
            <td width='20px'>:</td>
            <td><?= $detail_pegawai->nama_lengkap ?></td>
        </tr>
        <tr>
            <td>NIP</td>
            <td>:</td>
            <td><?= $detail_pegawai->nip ?></td>
        </tr>
        <tr>
            <td>JABATAN</td>
            <td>:</td>
            <td><?= $detail_pegawai->jabatan ?></td>
        </tr>
        <tr>
            <td>UNIT KERJA</td>
            <td>:</td>
            <td><?= $detail_pegawai->nama_unit_kerja ?></td>
        </tr>
    </table>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th width='20px'>NO</th>
                <th width='130px'>HARI/TANGGAL</th>
                <th>RINCIAN KEGIATAN</th>
                <th>HASIL</th>
                <th>KOMENTAR ATASAN</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($detail as $d) {
                $rincian_kegiatan = trim($d->rincian_kegiatan != strip_tags($d->rincian_kegiatan) ? $d->rincian_kegiatan : nl2br($d->rincian_kegiatan));
                $hasil_kegiatan = trim($d->hasil_kegiatan != strip_tags($d->hasil_kegiatan) ? $d->hasil_kegiatan : nl2br($d->hasil_kegiatan));
                $list_penolakan = $this->laporan_kinerja_harian_model->get_log($d->id_laporan_kerja_harian, 'ditolak');
                // if ($string != strip_tags($string)) {
                //     return true;
                // } else {
                //     return false;
                // }
            ?>
                <tr>
                    <td style="text-align: center;"><?= $no ?></td>
                    <td style="text-align: center;"><?= tanggal_hari($d->tanggal) ?></td>
                    <td><?= $rincian_kegiatan ?></td>
                    <td><?= $hasil_kegiatan ?></td>
                    <td>
                    <?php 
                    if(empty($list_penolakan)){
                        echo '<center>-</center>';
                    }else{
                        foreach($list_penolakan as $k => $p){
                            $tanggal_penolakan = explode(' ',$p->tanggal);
                            if(!empty($tanggal_penolakan)){
                                $tanggal_penolakan = $tanggal_penolakan[0];
                                $tanggal_penolakan = tanggal($tanggal_penolakan);
                            }else{
                                $tanggal_penolakan = "-";
                            }
                            ?>
                            <span style="display: block;"><b>Tanggal : </b> <?=$tanggal_penolakan?></span>
                            <span style="display: block;<?=count($list_penolakan)>1 && $k !== count($list_penolakan) - 1  ? 'margin-bottom:5px' : null ?>"><b>Alasan : </b> <?=$p->alasan_penolakan?></span>
                            <?php
                        }
                    }
                    ?>
                    </td>
                </tr>
            <?php
                $no++;
            }
            ?>
        </tbody>
    </table>
</body>

</html>