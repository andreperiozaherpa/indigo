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

    table.utama, table.titimangsa {
        border-collapse: collapse;
        width: 100%;
        table-layout: fixed;
    }

    th,
    td {
        font-size: 8px;
        word-wrap: break-word;
    }

    .utama td {
        padding: 5px;
    }
</style>

<body>
 <div class="judul">
<h4 class="box-title text-center">DAFTAR PENGAJUAN PERJALANAN DINAS KE LUAR DAERAH PER BAGIAN BULAN <?=strtoupper(bulan($bulan))?> <?=$tahun?></h4>
</div>
        <div class="table-responsive">
          <?php 
            $total = array();
          ?>
          <table class="utama">
            <thead>
              <tr>
                <?php
                foreach ($bagian as $b) { 
                    $total[$b->id_unit_kerja] = 0;
                   ?>
                  <th><?= $b->nama_alias ?></th>
                <?php } ?>
              </tr>
            </thead>
            <tbody>
              <?php
              for ($i = 0; $i < $total_row; $i++) {
              ?>
                <tr>
                  <?php
                  foreach ($bagian as $b) {
                    $nominal = number_format($jumlah_bagian[$b->id_unit_kerja][$i]['nominal'],0,",",".");
                    $total[$b->id_unit_kerja] += $jumlah_bagian[$b->id_unit_kerja][$i]['nominal'];
                    ?>
                    <td style="text-align:right"><?= $nominal ?></td>
                  <?php } ?>
                </tr>
              <?php } ?>
              <tr>
                <?php
                foreach ($bagian as $b) { 
                   ?>
                  <td style="font-weight: bold;text-align:right"><?= number_format($total[$b->id_unit_kerja],0,",",".") ?></td>
                <?php } ?></tr>
            </tbody>
          </table>
        </div>
</body>

</html>