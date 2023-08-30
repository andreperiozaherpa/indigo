<?php

header("Content-type: application/vnd-ms-excel");

header("Content-Disposition: attachment; filename=$title.xls");

header("Pragma: no-cache");

header("Expires: 0");

?>

<table id="myTable" class="table" border="1px">
    <thead>
        <tr>
            <th scope="col">No. </th>
            <th scope="col">Nama SKPD</th>
            <th scope="col">Jenis LKE</th>
            <th scope="col">Nilai LKE</th>
            <th scope="col">Nilai Auditor</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        ?>
        <?php foreach ($list as $rows) {
            $nilai = 0;
            $nilai_koreksi = 0;
            $indikator = $this->lembar_kerja_evaluasi_model->get_indikator_filter($jenis, 1, $tahun_lke, $rows->id_skpd);
            foreach ($indikator as $i) {
                $nilai +=  $i->nilai;
                $nilai_koreksi +=  $i->nilai_koreksi;
            }
        ?>
            <tr>
                <td><?= $no; ?></td>
                <td><?= $rows->nama_skpd ?></td>
                <td>
                    <?php if ($jenis == 'zi_wbk') {
                        echo "<b style='color:#4285F4;'>ZI WBK</b>";
                    } elseif ($jenis == 'rb') {
                        echo "<b style='color:#4285F4;'>Reformasi Birokrasi</b>";
                    } ?>
                </td>
                <td><?= $nilai ?></td>
                <td><?= $nilai_koreksi ?></td>
            </tr>
        <?php
            $no++;
        } ?>
    </tbody>
</table>