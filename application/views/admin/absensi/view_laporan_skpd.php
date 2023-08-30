<style>
    body {
        font-family: 'Times New Roman', Times, serif;
        font-size: 14px;
    }

    table.table {
        border-collapse: collapse;
        width: 100%;
        margin-top: 10px
    }

    .table th,
    .table td {
        padding: 8px;
        font-size: 12px;
    }

    .table th {
        background-color: #f2f2f2;
        text-align: center;
        font-size: 11px;
    }

    .text-center {
        text-align: center;
    }

    h4 {
        margin: 0px;
        margin-bottom: 5px;
    }
    table td{
        font-size: 12px;
    }
</style>
<html>

<body>
    <center>
        <h4>REKAPITULASI ABSEN</h4>
        <h4><?= $nama_skpd ?></h4>
        <h4>BULAN <?= strtoupper(bulan($bulan)) ?> TAHUN <?= $tahun ?></h4>
    </center>
    <table class="table" border="1" width="100%">

        <thead>
            <tr>
                <th rowspan="2" width="2%">No</th>
                <th width="12%" rowspan="2">NIP</th>
                <th width="28%" rowspan="2">Nama</th>
                <th class="text-center" colspan="9">Jumlah Hari</th>
                <th rowspan="2" style="text-align:center">Total Masuk Telat</th>
                <th rowspan="2" style="text-align:center">Total Pulang Cepat</th>
            </tr>
            <tr>
                <th width="3%">H</th>
                <th width="3%">S</th>
                <th width="3%">CT</th>
                <th width="3%">TK</th>
                <th width="3%">DD</th>
                <th width="3%">DL</th>
                <th width="3%">IM</th>
                <th width="3%">WFH</th>
                <th width="3%">MPP</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($dt_pegawai)) {
                $no = 1;
                foreach ($dt_pegawai as $row) {
                    $ket_log = ['sakit','cuti','tk','dd','dl','im','wfh','mpp'];
                    $list_log = array();
                    foreach ($ket_log as $log) {
                        $dlog = $this->absen_model->get_ket_log_pegawai_by_group($row->id_pegawai, $bulan, $tahun, $log);
                        $list_log[$log] = count($dlog);
                    }
            ?>
                    <tr>
                        <td align="center"><?= $no; ?></td>
                        <td><?= $row->nip; ?></td>
                        <td><?= $row->nama_lengkap ?></td>
                        <td align="center"><?= $row->jumlah; ?></td>
                        <?php
                        foreach ($ket_log as $log) {
                        ?>
                            <td align="center"><?= $list_log[$log] ?></td>
                        <?php
                        }
                        ?>
                        <td align="center"><?= number_format($row->total_masuk_telat); ?> menit</td>
                        <td align="center"><?= number_format($row->total_pulang_cepat); ?> menit</td>
                    </tr>
            <?php $no++;
                }
            } ?>
        </tbody>
    </table>
    
    <span style="display: block;font-weight:700;margin-top:20px">Keterangan</span>
                    <table>
                        <tr>
                            <td>H</td>
                            <td width="20px" class="text-center">:</td>
                            <td>Hadir</td>
                            <td>S</td>
                            <td width="20px" class="text-center">:</td>
                            <td>Sakit</td>
                        </tr>
                        <tr>
                            <td>CT</td>
                            <td width="20px" class="text-center">:</td>
                            <td>Cuti</td>
                            <td>TK</td>
                            <td width="20px" class="text-center">:</td>
                            <td>Tanpa Keterangan</td>
                        </tr>
                        <tr>
                            <td>DD</td>
                            <td width="20px" class="text-center">:</td>
                            <td width="100px">Dinas Dalam</td>
                            <td>DL</td>
                            <td width="20px" class="text-center">:</td>
                            <td>Dinas Luar</td>
                        </tr>
                        <tr>
                            <td>IM</td>
                            <td width="20px" class="text-center">:</td>
                            <td width="100px">Isolasi Mandiri</td>
                            <td>WFH</td>
                            <td width="20px" class="text-center">:</td>
                            <td>Work from Home</td>
                        </tr>
                        <tr>
                            <td>MPP</td>
                            <td width="20px" class="text-center">:</td>
                            <td width="100px">Masa Persiapan Pensiun</td>
                        </tr>
                    </table>
</body>

</html>